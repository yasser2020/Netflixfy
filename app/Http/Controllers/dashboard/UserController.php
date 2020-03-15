<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $roles=Role::whereRoleNot(['super_admin','administrator'])->get();
        $users=User::WhereRoleNot(['super_admin'])->whenSearch($request->search)
        ->WhenRole($request->role_id)
        ->with('roles')->paginate(5);
        return view('dashboard.users.index',compact('users','roles'));
    }

    
    public function create()
    {
         $roles=Role::whereRoleNot(['super_admin','administrator'])->get();
         return view('dashboard.users.create',compact('roles'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
            'role_id'=>'required|numeric',
        ]);
        $request->merge(['password'=>bcrypt($request->password)]);
       $user= User::create($request->all());
       $user->attachRoles(['administrator',$request->role_id]);
        session()->flash('success','Data Add Successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function show($id)
    {
        //
    }

  
    public function edit(User $user)
    {
        $roles=Role::whereRoleNot(['super_admin','administrator'])->get();
        return view('dashboard.users.edit',compact('user','roles'));
    }

   
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'role_id'=>'required|numeric',
        ]);
        // $request->merge(['password'=>bcrypt($request->password)]);
       $user->update($request->all());
       $user->syncRoles(['administrator',$request->role_id]);
        session()->flash('success','Data Add Successfully');
        return redirect()->route('dashboard.users.index');
    }

   
    public function destroy(User $user)
    {
        $user->delete();
       
        session()->flash('success','Data Deleted Successfully');
        return redirect()->route('dashboard.users.index');

    }
}
