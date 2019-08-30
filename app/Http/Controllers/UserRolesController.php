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
           'roles' => 'sometimes|array',
           'roles.*' => 'sometimes|numeric|exists:roles,id'
       ]);
       
       $roles = Role::whereIn('id', \request('roles'))->get();
       
        $user->addRole($roles);
        
        return back();
    }
}
