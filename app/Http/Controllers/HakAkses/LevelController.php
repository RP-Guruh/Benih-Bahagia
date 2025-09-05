<?php

namespace App\Http\Controllers\HakAkses;

use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    
    public function __construct()
    {
        PermissionHelper::apply($this, 'access/level');
    }
    
    public function index()
    {
        return view('access.level.index');
    }


    public function datatable(Request $request)
    {
        $query = Level::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('access.level.show', $row->id);
                $editUrl = route('access.level.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    public function create()
    {
        return view('access.level.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name',
            'description' => 'required|string|max:255',
        ]);

        try {
          
            $level = new Level();
            $level->name = $validated['name'];
            $level->description = $validated['description'];
            $level->created_by = auth()->user()->id;
            $level->save();


            return redirect()->route('access.level.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Level Access created successfully.'
            ]);
        } catch (\Exception $e) {

            \Log::error('Error creating level access: ' . $e->getMessage());
          
            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to create level access. Please try again.'
                ]);
        }
    }


    public function show($id)
    {
        $level = Level::findOrFail($id);
        return view('access.level.show', compact('level'));
    }

    public function edit($id) {
        $level = Level::findOrFail($id);
        return view('access.level.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        $level = Level::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name,' . $level->id,
            'description' => 'required|string|max:255',
        ]);
        
        try {
          
            $level->name = $validated['name'];
            $level->description = $validated['description'];
            $level->updated_by = auth()->user()->id;
            $level->save();

            return redirect()->route('access.level.index')->with('alert', [
                'type'    => 'success',
                'title'   => 'Success!',
                'message' => 'Level access updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating level access: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type'    => 'danger',
                    'title'   => 'Failed!',
                    'message' => 'Failed to update level access. Please try again.'
                ]);
        }
    }

}