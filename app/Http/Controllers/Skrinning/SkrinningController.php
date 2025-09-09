<?php

namespace App\Http\Controllers\Skrinning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Formulir;
use App\Models\Jawaban;
use App\Models\Pertanyaan;

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
        $query = Article::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
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

            $birth  = Carbon::parse($tanggal_lahir);
            $today  = Carbon::today();

            $usia_bulan = (int) $birth->diffInMonths($today);

            $sisa_hari  = $today->day - $birth->day;

            if ($sisa_hari < 0) {
                $usia_bulan -= 1;

                $sisa_hari = $birth->copy()->addMonths($usia_bulan)->diffInDays($today);
            }
            // format usia aktual
            $usia_aktual = $usia_bulan . ' bulan ' . $sisa_hari . ' hari';

            // pembulatan bulan jika sisa hari > 17
            $usia_pembulatan = ($sisa_hari > 17) ? $usia_bulan + 1 : $usia_bulan;


            $jawaban = $request->except([
                '_token', 
                'nama_siswa', 
                'nama_orangtua', 
                'tgl_lahir', 
                'umur_hari', 
                'formulir_id'
            ]);
            
           
            $jawaban = $request->jawaban ?? []; // misalnya datang dari form

           
            $bersih = array_filter($jawaban, fn($v) => is_string($v) || is_int($v));

            $hitung = array_count_values($bersih);

            $total_ya = $hitung['ya'] ?? 0;
            $total_tidak = $hitung['tidak'] ?? 0;

            $jawaban_id = Jawaban::where('nilai_min', '<=', $total_ya)->where('nilai_max', '>=', $total_ya)->first();
         
            HasilSkrinning::create([
                'nama_siswa'      => $nama_siswa,
                'nama_orangtua'   => $nama_orangtua,
                'tanggal_lahir'   => $tanggal_lahir,
                'formulir_id'     => $formulir_id,
                'usia_aktual'     => $usia_aktual,
                'usia_pembulatan' => $usia_pembulatan,
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
            dd('pesan : '. $e->getMessage());
            return redirect()->back()->with('alert', [
                'type'    => 'error',
                'title'   => 'Terjadi Kesalahan!',
                'message' => $e->getMessage()
            ]);
        }
    }

}