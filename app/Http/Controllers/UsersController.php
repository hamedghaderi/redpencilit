<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    
    /**
     * Get the list of all users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (request()->has('type') && request('type') === 'coworkers') {
            $users = User::whereHas('roles')->paginate(10);
        } else if (request()->has('type') && request('type') === 'customers') {
            $users = User::whereDoesntHave('roles')->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        $roles = Role::all();
        
        return view('admin.users.index', compact('users', 'roles'));
    }
    
    /**
     * Update user details.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user)
    {
        $attributes = request()->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'phone' => ['required', 'regex:/^09\d{9}$/', 'numeric'],
            ]);
        
        $user->update($attributes);
        
        return redirect('/dashboard/'.$user->username);
    }
    
    /**
     * Delete a user from DB.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect('/users');
    }
}
