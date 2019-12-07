<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function update($locale, User $user)
    {
        $attributes = request()->validate([
            'roles.*' => 'sometimes|numeric|exists:roles,id'
        ]);
        
        !array_key_exists('roles', $attributes) ?
            $user->roles()->detach() :
            $user->addRole($attributes['roles']);
        
        return back();
    }
}
