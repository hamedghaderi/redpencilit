<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    
    /**
     * Set a role(s) for given user.
     *
     * @param        $locale
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale, User $user)
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
