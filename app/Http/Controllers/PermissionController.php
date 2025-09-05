<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Action;
use App\Models\UserMenuAction;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
       public function index()
    {
        $users = User::all();
        return view('permissions.index', compact('users'));
    }

    public function edit(User $user)
    {
        $menus   = Menu::all();
        $actions = Action::all();

        return view('permissions.edit', compact('user','menus','actions'));
    }

    public function update(Request $request, User $user)
    {
        $user->menuActions()->delete();

        if ($request->has('permissions')) {
            foreach ($request->permissions as $menuId => $actionIds) {
                foreach ($actionIds as $actionId) {
                    UserMenuAction::create([
                        'user_id'  => $user->id,
                        'menu_id'  => $menuId,
                        'action_id'=> $actionId,
                    ]);
                }
            }
        }

        return redirect()->route('permissions.index')->with('success', 'Hak akses diperbarui');
    }

}
