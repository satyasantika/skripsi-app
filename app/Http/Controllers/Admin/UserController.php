<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index($search = '')
    {
        $users = User::where('name','like','%'.$search.'%')
                        ->orWhere('username','like','%'.$search.'%')
                        ->orWhere('email','like','%'.$search.'%')
                        ->orWhere('phone','like','%'.$search.'%')
                        ->orWhere('address','like','%'.$search.'%')
                        ->latest()
                        ->get();
        return view('admin.user.home',compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $roles = Role::all()->pluck('name');
        return view('admin.user.show',compact('user','roles'));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function search(Request $request)
    {
        return $this->index($request->search);
    }

    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return redirect()->route('user.show',$user);
    }

    public function removeRole($user, $role)
    {
        return $user->removeRole($role);
    }
}
