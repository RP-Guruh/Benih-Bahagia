<?php

namespace App\Http\Controllers\HakAkses;

use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use App\Models\{Level, LevelMenuAction, Menu, Action};
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LevelPermissionController extends Controller
{

    public function __construct()
    {
        PermissionHelper::apply($this, 'access/permission');
    }

    public function index()
    {
        return view('access.permission.index');
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
                $showUrl = route('access.permission.show', $row->id);
                $editUrl = route('access.permission.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

   public function show($levelId)
{
    try {
        $level = Level::with(['permissions.menu', 'permissions.action'])->find($levelId);

        if (!$level || $level->permissions->isEmpty()) {
            return redirect()->route('access.permission.index')->with('alert', [
                'type'    => 'warning',
                'title'   => 'Notice!',
                'message' => 'This level has no permissions yet. Please add permissions first.'
            ]);
        }

       
        $permissionsByMenu = $level->permissions->groupBy(function($perm) {
            return $perm->menu->name ?? 'Unknown Menu';
        });

        return view('access.permission.show', compact('level', 'permissionsByMenu'));

    } catch (\Exception $e) {
        \Log::error('Failed to show permissions for level ID ' . $levelId . ': ' . $e->getMessage());

        return redirect()->route('access.permission.index')->with('alert', [
            'type'    => 'danger',
            'title'   => 'Error!',
            'message' => 'Failed to load level permissions. Please try again.'
        ]);
    }
}

    public function edit($id)
    {
        $level = Level::with([
            'permissions' => function($q) {
                $q->join('menus', 'level_menu_action.menu_id', '=', 'menus.id')
                ->join('actions', 'level_menu_action.action_id', '=', 'actions.id')
                ->select('level_menu_action.*')
                ->orderBy('menus.name', 'asc')
                ->orderBy('actions.name', 'asc');
            },
            'permissions.menu',
            'permissions.action'
        ])->findOrFail($id);
        $menu = Menu::all();
        $action = Action::all();
        return view('access.permission.edit', compact('level', 'menu', 'action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id.*' => 'required|exists:menus,id',
            'action_id.*' => 'required|exists:actions,id',
        ]);

        try {
            $level = Level::findOrFail($request->level_id ?? $request->route('id'));

            $menuIds = $request->menu_id;
            $actionIds = $request->action_id;

            for ($i = 0; $i < count($menuIds); $i++) {
                
                $exists = LevelMenuAction::where('level_id', $level->id)
                    ->where('menu_id', $menuIds[$i])
                    ->where('action_id', $actionIds[$i])
                    ->exists();
              
                if (!$exists) {
                    LevelMenuAction::create([
                        'level_id' => $level->id,
                        'menu_id' => $menuIds[$i],
                        'action_id' => $actionIds[$i],
                        'created_by' => auth()->user()->id,
                    ]);
                }
                else {
                    return redirect()->route('access.permission.edit', $level->id)->with('alert', [
                        'type' => 'warning',
                        'title' => 'Duplicate!',
                        'message' => 'The selected action for this menu already exists.'
                    ]);
                }
            }

            return redirect()->route('access.permission.edit', $level->id)->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Permissions added successfully.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to add permissions', [
                'level_id' => $request->level_id,
                'menus' => $request->menu_id,
                'actions' => $request->action_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('alert', [
                    'type' => 'danger',
                    'title' => 'Failed!',
                    'message' => 'Failed to add permissions. Please try again.'
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'action_id' => 'required|exists:actions,id',
        ]);

        try {
            $permission = LevelMenuAction::findOrFail($id);

            // Cek duplikasi 
            $exists = LevelMenuAction::where('level_id', $permission->level_id)
                ->where('menu_id', $request->menu_id)
                ->where('action_id', $request->action_id)
                ->where('id', '<>', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()->withInput()->with('alert', [
                    'type' => 'warning',
                    'title' => 'Duplicate!',
                    'message' => 'The selected action for this menu already exists.'
                ]);
            }

            $permission->update([
                'menu_id' => $request->menu_id,
                'action_id' => $request->action_id,
            ]);

            return redirect()->route('access.permission.edit', $permission->level_id)->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Permission updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to update permission', [
                'permission_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to update permission. Please try again.'
            ]);
        }
    }


    public function destroy($id)
    {
        try {
            $permission = LevelMenuAction::findOrFail($id);
            $permission->delete();

            return redirect()->route('access.permission.edit', $permission->level_id)->with('alert', [
                'type' => 'success',
                'title' => 'Deleted!',
                'message' => 'Permission removed successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to delete permission', [
                'permission_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to remove permission. Please try again.'
            ]);
        }
    }


}