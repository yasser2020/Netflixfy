<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
class RoleController extends Controller
{
    public function __construct()
    {
     $this->middleware('permission:read_roles')->only('index');   
     $this->middleware('permission:create_roles')->only(['create','store']); 
     $this->middleware('permission:update_roles')->only(['edit','update']); 
     $this->middleware('permission:delete_roles')->only(['destory']); 
    }
    public function index(Request $request)
    {
        $roles=Role::whereRoleNot(['super_admin'])->whenSearch($request->search)->with('permissions')->withCount('users')->paginate(5);
        return view('dashboard.roles.index',compact('roles'));
    }

   
    public function create()
    {
        return view('dashboard.roles.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name',
            'permissions'=>'required|array|min:1'
        ]);
       $role= Role::create($request->all());
       $role->attachPermissions($request->permissions);
        session()->flash('success','Data Add Successfully');
        return redirect()->route('dashboard.roles.index');
      
    }


    public function edit(Role $role)
    {
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$role->id,
            'permissions'=>'required|array|min:1'
        ]);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        session()->flash('success','Data Updated Successfully');
        return redirect()->route('dashboard.roles.index');

    }

    
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success','Data Deleted Successfully');
        return redirect()->route('dashboard.roles.index');

    }
}
