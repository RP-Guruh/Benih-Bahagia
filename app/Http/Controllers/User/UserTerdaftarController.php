<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use Carbon\Carbon;
use Exception;
use App\Models\User;

class UserTerdaftarController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'user/terdaftar');
    }

        public function index()
    {
        return view('user.terdaftar.index');
    }

    public function datatable(Request $request)
    {
        $query = User::query()
            ->where('level_id', 2)
            ->withCount('skrinning'); 

        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->editColumn('created_at', function ($row) {
                return \Carbon\Carbon::parse($row->created_at)->translatedFormat('d F Y');
            })
            ->addColumn('action', function ($row) {
                $showUrl = route('user.terdaftar.show', $row->id);
                $editUrl = route('user.terdaftar.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        return redirect()->route('user.terdaftar.index')->with('alert', [
                    'type'    => 'danger',
                    'title'   => 'Opps!',
                    'message' => 'Tidak terdapat halaman detail pada menu ini.',
        ]);
    }

    public function edit() {
        return redirect()->route('user.terdaftar.index')->with('alert', [
                    'type'    => 'danger',
                    'title'   => 'Opps!',
                    'message' => 'Tidak terdapat halaman edit pada menu ini.',
        ]);
    }

}