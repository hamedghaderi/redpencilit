<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function update(User $user)
    {
        $attributes = request()->validate([
            'roles.*' => 'sometimes|numeric|exists:roles,id'
        ]);
        
        if (!array_key_exists('roles', $attributes)) {
            $user->roles()->detach();
        } else {
            $user->addRole($attributes['roles']);
        }
        
        return back();
    }
}
