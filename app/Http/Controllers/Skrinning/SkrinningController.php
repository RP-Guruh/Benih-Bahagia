<?php

namespace App\Http\Controllers\Skrinning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Formulir;
use App\Models\Jawaban;
use App\Models\Pertanyaan;


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
}