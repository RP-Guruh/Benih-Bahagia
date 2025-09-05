<?php

namespace App\Http\Controllers\Setting;

use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'settings/menu');
    }
    public function index()
    {
        return view('settings.menu.index');
    }


    public function datatable(Request $request)
    {
        $query = Menu::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('settings.menu.show', $row->id);
                $editUrl = route('settings.menu.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }



    public function create()
    {
        return view('settings.menu.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'menu' => 'required|string|max:255',
        ]);

        try {

            $menu = new Menu();
            $menu->code = $validated['key'];
            $menu->name = $validated['menu'];
            $menu->save();


            return redirect()->route('settings.menu.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Menu created successfully.'
            ]);
        } catch (\Exception $e) {

            \Log::error('Error creating menu: ' . $e->getMessage());
          
            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to create menu. Please try again.'
                ]);
        }
    }


    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('settings.menu.show', compact('menu'));
    }

    public function edit($id) {
        $menu = Menu::findOrFail($id);
        return view('settings.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'key'  => 'required|string|max:255',
            'menu' => 'required|string|max:255',
        ]);

        try {
            $menu = Menu::findOrFail($id);

            $menu->code  = $validated['key'];
            $menu->name = $validated['menu'];
            $menu->save();

            return redirect()->route('settings.menu.index')->with('alert', [
                'type'    => 'success',
                'title'   => 'Success!',
                'message' => 'Menu updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating menu: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type'    => 'danger',
                    'title'   => 'Failed!',
                    'message' => 'Failed to update menu. Please try again.'
                ]);
        }
    }



}