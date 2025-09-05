<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleAccessController extends Controller
{
  
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required|unique:roles,name']);
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success','Role berhasil dibuat');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name'=>'required']);
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success','Role berhasil diupdate');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success','Role berhasil dihapus');
    }
}
