<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MenuActionController extends Controller
{
    public function index()
    {
        return view('settings.menu_actions.index');
    }


    public function datatable(Request $request)
    {
        $query = Action::query();


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
                $showUrl = route('settings.menu_action.show', $row->id);
                $editUrl = route('settings.menu_action.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('settings.menu_actions.create');
    }

    public function show($id)
    {
        $action = Action::findOrFail($id);
        return view('settings.menu_actions.show', compact('action'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        try {

            $action = new Action();
            $action->code = $validated['code'];
            $action->name = $validated['name'];
            $action->save();


            return redirect()->route('settings.menu_action.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Menu Action created successfully.'
            ]);
        } catch (\Exception $e) {

            \Log::error('Error creating menu action: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to create menu action. Please try again.'
                ]);
        }
    }

    public function edit($id) {
        $action = Action::findOrFail($id);
        return view('settings.menu_actions.edit', compact('action'));
    }

        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code'  => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        try {
            $action = Action::findOrFail($id);

            $action->code  = $validated['code'];
            $action->name = $validated['name'];
            $action->save();

            return redirect()->route('settings.menu_action.index')->with('alert', [
                'type'    => 'success',
                'title'   => 'Success!',
                'message' => 'Menu Action updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating menu action: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type'    => 'danger',
                    'title'   => 'Failed!',
                    'message' => 'Failed to update menu action. Please try again.'
                ]);
        }
    }



}