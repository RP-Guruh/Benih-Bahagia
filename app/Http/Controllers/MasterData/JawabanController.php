<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Jawaban;
use App\Models\JawabanIntervensiRow;
use Illuminate\Support\Facades\DB;

class JawabanController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'masterdata/jawaban');
    }

        public function index()
    {
        return view('masterdata.jawaban.index');
    }

    public function datatable(Request $request)
    {
        $query = Jawaban::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('interpretasi', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('masterdata.jawaban.show', $row->id);
                $editUrl = route('masterdata.jawaban.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('masterdata.jawaban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nilai_min'     => 'required|integer',
            'nilai_max'     => 'required|integer',
            'interpretasi'  => 'required|string',
            'intervensi'    => 'nullable|array',
            'intervensi.*.jawaban' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
           
            $jawaban = Jawaban::create([
                'nilai_min'    => $request->nilai_min,
                'nilai_max'    => $request->nilai_max,
                'interpretasi' => $request->interpretasi,
            ]);

            
            if ($request->has('intervensi')) {
                foreach ($request->intervensi as $row) {
                    if (!empty($row['jawaban'])) {
                        JawabanIntervensiRow::create([
                            'jawaban_id' => $jawaban->id,
                            'intervensi'    => $row['jawaban'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('masterdata.jawaban.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Jawaban berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('masterdata.jawaban.index')->with('alert', [
                'type' => 'danger',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $jawaban = Jawaban::with('intervensiRows')->findOrFail($id);

        return view('masterdata.jawaban.show', compact('jawaban'));
    }

    public function edit($id)
    {
        $jawaban = Jawaban::with('intervensiRows')->findOrFail($id);

        return view('masterdata.jawaban.edit', compact('jawaban'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai_min'     => 'required|integer',
            'nilai_max'     => 'required|integer|gte:nilai_min',
            'interpretasi'  => 'required|string',
            'intervensi'    => 'nullable|array',
            'intervensi.*'  => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $jawaban = Jawaban::findOrFail($id);

            $jawaban->update([
                'nilai_min'    => $request->nilai_min,
                'nilai_max'    => $request->nilai_max,
                'interpretasi' => $request->interpretasi,
            ]);

            $jawaban->intervensiRows()->delete();

            if ($request->filled('intervensi')) {
                foreach ($request->intervensi as $row) {
                    if ($row !== null && trim($row) !== '') {
                        $jawaban->intervensiRows()->create([
                            'intervensi' => $row
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('masterdata.jawaban.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Jawaban updated successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Failed to update jawaban: ' . $e->getMessage()
            ]);
        }
    }





}