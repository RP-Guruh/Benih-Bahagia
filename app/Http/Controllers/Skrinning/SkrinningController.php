<?php

namespace App\Http\Controllers\Skrinning;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Formulir;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use App\Models\HasilSkrinning;

class SkrinningController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'skrinning/siswa');
    }

        public function index()
    {
        return view('skrinning.siswa.index');
    }

    public function datatable(Request $request)
    {
        $query = HasilSkrinning::query();
        $query->with('formulir');
        
        $query->where('user_id', Auth::user()->id); // data dilihat berdasarkan id nya saja
        

        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('nama_orangtua', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('skrinning.siswa.show', $row->id);
                $editUrl = route('skrinning.siswa.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('skrinning.siswa.create');
    }

    public function formulir($usia)
    {
            $formulir = Formulir::with('pertanyaan')
                ->where('usia_min', '<=', $usia)
                ->where('usia_max', '>=', $usia)
                ->first();
            return response()->json($formulir);
    }

    public function store(Request $request)
    {
     
        try {
            // ambil inputan
            $nama_siswa     = $request->nama_siswa;
            $nama_orangtua  = $request->nama_orangtua;
            $tanggal_lahir  = $request->tgl_lahir; // dari form Step 1
            $formulir_id    = $request->formulir_id;
            $user_id        = auth()->id();
            $usia_aktual = $request->umur_aktual;
            $prematur_info = $request->prematur_info == 'YA' ? 'Y' : 'N';
            $usia_lahir_prematur = $request->usia_lahir_prematur ?? null;
            $usia_setelah_koreksi_prematur = $request->usia_setelah_koreksi ?? null;
            $usia_pembulatan = $request->usia_pembulatan;
            $jawaban = $request->except([
                '_token', 
                'nama_siswa', 
                'nama_orangtua', 
                'tgl_lahir', 
                'umur_hari', 
                'formulir_id'
            ]);
            
            $bobot_pertanyaan = Pertanyaan::where('formulir_id', $formulir_id)
                ->pluck('bobot_nilai', 'id')
                ->toArray();

            $jawaban = $request->jawaban ?? []; // misal: [1=>'ya', 2=>'tidak', ...]
            $total_ya = 0;
            $total_tidak = 0;

            foreach ($jawaban as $pertanyaan_id => $jawaban_val) {
                $bobot = $bobot_pertanyaan[$pertanyaan_id] ?? 0;

                if ($jawaban_val === 'ya') {
                    $total_ya += $bobot;
                } elseif ($jawaban_val === 'tidak') {
                    $total_tidak += $bobot;
                }
            }
            
            $jawaban_id = Jawaban::where('nilai_min', '<=', $total_ya)->where('nilai_max', '>=', $total_ya)->first();
           
            HasilSkrinning::create([
                'nama_siswa'      => $nama_siswa,
                'nama_orangtua'   => $nama_orangtua,
                'tanggal_lahir'   => $tanggal_lahir,
                'formulir_id'     => $formulir_id,
                'usia_aktual'     => $usia_aktual,
                'usia_pembulatan' => $usia_pembulatan,
                'prematur'        => $prematur_info,
                'prematur_minggu' => $usia_lahir_prematur,
                'usia_setelah_koreksi_prematur' => $usia_setelah_koreksi_prematur,
                'jawaban'         => json_encode($jawaban),
                'total_ya'        => $total_ya,
                'total_tidak'     => $total_tidak,
                'total_skor'      => $total_ya,
                'jawaban_id'      => $jawaban_id->id ?? null,
                'user_id'         => $user_id,
            ]);

            return redirect()->route('skrinning.siswa.index')->with('alert', [
                'type'    => 'success',
                'title'   => 'Berhasil!',
                'message' => 'Hasil skrining siswa berhasil disimpan.'
            ]);

        } catch (Exception $e) {
            return redirect()->back()->with('alert', [
                'type'    => 'error',
                'title'   => 'Terjadi Kesalahan!',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $hasil = HasilSkrinning::with(['formulir', 'evaluasi.intervensiRows', 'guru'])->findOrFail($id);
        return view('skrinning.siswa.show', compact('hasil'));
    }

    public function print($id)
    {
        $hasil = HasilSkrinning::with(['formulir', 'evaluasi.intervensiRows', 'guru'])->findOrFail($id);
        $pdf = Pdf::loadView('skrinning.siswa.pdf', compact('hasil'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('hasil_skrinning_'.$hasil->id.'.pdf');
    }

    public function edit($id)
    {
        $hasil = HasilSkrinning::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();

        if(!$hasil) {
            return redirect()->back()->with('alert', [
                'type'    => 'error',
                'title'   => 'Terjadi Kesalahan!',
                'message' => 'Data tidak ditemukan atau Anda tidak memiliki izin untuk mengedit data ini.'
            ]);
        }

        if ($hasil->created_at->diffInDays(now()) > 7) {
            return redirect()->route('hasil.show', $hasil->id)
                ->with('error', 'Data hanya bisa diubah dalam 1 minggu setelah dibuat.');
        }

        $formulir = null;

        if (!empty($hasil->formulir_id)) {
            $formulir = Formulir::with('pertanyaan')->find($hasil->formulir_id);
        }

        $jawaban = json_decode($hasil->jawaban ?? '[]', true) ?: [];

        return view('skrinning.siswa.edit', compact('hasil', 'formulir', 'jawaban'));
    }


}