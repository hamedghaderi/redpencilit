<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'regex:/^09\d{9}$/','numeric'],
        ]);

       $user->update($attributes);


       return redirect('/dashboard/' . $user->username);
    }
}
