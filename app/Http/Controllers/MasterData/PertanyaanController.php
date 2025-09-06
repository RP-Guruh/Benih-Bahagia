<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Pertanyaan;
use App\Models\Formulir;

class PertanyaanController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'masterdata/pertanyaan');
    }

    public function index()
    {
        return view('masterdata.pertanyaan.index');
    }

    public function datatable(Request $request)
    {
        $query = Pertanyaan::query();
        $query->with('formulir');

        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('pertanyaan.teks', 'like', "%{$search}%")
                    ->orWhere('pertanyaan.kategori', 'like', "%{$search}%")
                    ->orWhereHas('formulir', function ($q2) use ($search) {
                        $q2->where('judul', 'like', "%{$search}%");
                    });
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('masterdata.pertanyaan.show', $row->id);
                $editUrl = route('masterdata.pertanyaan.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        $formulirs = Formulir::orderBy('id')->get();
        return view('masterdata.pertanyaan.create', compact('formulirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'formulir_id' => 'required|exists:formulir,id',
            'nomor.*' => 'required|integer',
            'teks.*' => 'required|string',
            'kategori.*' => 'required|in:Gerak halus,Gerak kasar,Bicara dan bahasa,Sosialisasi dan kemandirian',
            'tipe_jawaban.*' => 'required|in:Ya/Tidak',
            'bobot_nilai.*' => 'required|integer|min:1',
            'petunjuk_gambar.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        try {
            $formulir = Formulir::findOrFail($request->formulir_id);

           
            $jumlahPertanyaan = count($request->teks);
            if($jumlahPertanyaan > $formulir->jumlah_pertanyaan){
                return redirect()->back()->withInput()->with('alert', [
                    'type' => 'danger',
                    'title' => 'Error!',
                    'message' => "Formulir ini hanya boleh memiliki maksimal {$formulir->jumlah_pertanyaan} pertanyaan."
                ]);
            }

            foreach($request->teks as $index => $teks){
                $pertanyaan = new Pertanyaan();
                $pertanyaan->formulir_id = $request->formulir_id;
                $pertanyaan->nomor = $request->nomor[$index];
                $pertanyaan->teks = $teks;
                $pertanyaan->kategori = $request->kategori[$index];
                $pertanyaan->tipe_jawaban = $request->tipe_jawaban[$index];
                $pertanyaan->bobot_nilai = $request->bobot_nilai[$index];

            
                if($request->hasFile('petunjuk_gambar') && isset($request->file('petunjuk_gambar')[$index])){
                    $file = $request->file('petunjuk_gambar')[$index];
                    $filename = time().'_'.$index.'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('pertanyaan/petunjuk_gambar'), $filename);
                    $pertanyaan->petunjuk_gambar = 'pertanyaan/petunjuk_gambar/'.$filename;
                }

                $pertanyaan->save();
            }

            return redirect()->route('masterdata.pertanyaan.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Pertanyaan berhasil ditambahkan.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error creating pertanyaan: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Gagal menambahkan pertanyaan. Silakan coba lagi.'
            ]);
        }
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::with('formulir')->findOrFail($id);
        return view('masterdata.pertanyaan.show', compact('pertanyaan'));
    }


    public function edit($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $formulirs = Formulir::orderBy('id')->get();
        return view('masterdata.pertanyaan.edit', compact('pertanyaan', 'formulirs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'formulir_id' => 'required|exists:formulir,id',
            'nomor' => 'required|integer',
            'teks' => 'required|string',
            'kategori' => 'required|in:Gerak halus,Gerak kasar,Bicara dan bahasa,Sosialisasi dan kemandirian',
            'tipe_jawaban' => 'required|in:Ya/Tidak',
            'bobot_nilai' => 'required|integer|min:1',
            'petunjuk_gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        try {
            $pertanyaan = Pertanyaan::findOrFail($id);

            $pertanyaan->formulir_id = $request->formulir_id;
            $pertanyaan->nomor = $request->nomor;
            $pertanyaan->teks = $request->teks;
            $pertanyaan->kategori = $request->kategori;
            $pertanyaan->tipe_jawaban = $request->tipe_jawaban;
            $pertanyaan->bobot_nilai = $request->bobot_nilai;

            if($request->hasFile('petunjuk_gambar')){
                $file = $request->file('petunjuk_gambar');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('pertanyaan/petunjuk_gambar'), $filename);
                $pertanyaan->petunjuk_gambar = 'pertanyaan/petunjuk_gambar/'.$filename;
            }

            $pertanyaan->save();

            return redirect()->route('masterdata.pertanyaan.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Pertanyaan berhasil diperbarui.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error updating pertanyaan: '.$e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Gagal memperbarui pertanyaan. Silakan coba lagi.'
            ]);
        }
    }






}