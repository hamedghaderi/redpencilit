<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    
    public function store(User $user)
    {
       request()->validate([
           'role_id' => 'required|numeric|exists:roles,id'
       ]);
       
       $role = Role::where('id', \request('role_id'))->first();
       
        $user->addRole($role);
        
        return back();
    }
}
