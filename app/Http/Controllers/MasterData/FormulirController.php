<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Formulir;

class FormulirController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'masterdata/formulir');
    }

    public function index()
    {
        return view('masterdata.formulir.index');
    }

    public function datatable(Request $request)
    {
        $query = Formulir::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('masterdata.formulir.show', $row->id);
                $editUrl = route('masterdata.formulir.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        return view('masterdata.formulir.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:formulir,judul',
            'jumlah_pertanyaan' => 'required|integer|min:0',
            'usia_min' => 'required|integer|min:0',
            'usia_max' => 'required|integer|min:0|gte:usia_min',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $formulir = new Formulir();
            $formulir->judul = $validated['judul'];
            $formulir->jumlah_pertanyaan = $validated['jumlah_pertanyaan'];
            $formulir->usia_min = $validated['usia_min'] ?? null;
            $formulir->usia_max = $validated['usia_max'] ?? null;
            $formulir->deskripsi = $validated['deskripsi'] ?? null;
            $formulir->status = $validated['status'];
            $formulir->save();

            return redirect()->route('masterdata.formulir.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Formulir created successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating formulir: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to create formulir. Please try again.'
                ]);
        }
    }

    public function show($id)
    {
        $formulir = Formulir::with('pertanyaan')->findOrFail($id);
        return view('masterdata.formulir.show', compact('formulir'));
    }

    public function edit($id)
    {
        $formulir = Formulir::findOrFail($id);
        return view('masterdata.formulir.edit', compact('formulir'));
    }

    public function update(Request $request, Formulir $formulir)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:formulir,judul,' . $formulir->id,
            'jumlah_pertanyaan' => 'required|integer|min:0',
            'usia_min' => 'required|integer|min:0',
            'usia_max' => 'required|integer|min:0|gte:usia_min',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $formulir->judul = $validated['judul'];
            $formulir->jumlah_pertanyaan = $validated['jumlah_pertanyaan'];
            $formulir->usia_min = $validated['usia_min'] ?? null;
            $formulir->usia_max = $validated['usia_max'] ?? null;
            $formulir->deskripsi = $validated['deskripsi'] ?? null;
            $formulir->status = $validated['status'];
            $formulir->save();

            return redirect()->route('masterdata.formulir.index', $formulir->id)->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Formulir updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating formulir: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to update formulir. Please try again.'
                ]);
        }
    }


}
