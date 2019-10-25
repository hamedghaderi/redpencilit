<?php

namespace App\Http\Controllers;

use App\CollegeDegree;
use App\Country;
use App\Role;
use App\User;

class DashboardController extends Controller
{
    public function index(User $user)
    {
        if (! auth()->user()->isSuperAdmin() && auth()->user()->id != $user->id) {
            abort(403);
        }
        
        $countries = Country::all();
        
        $roles = Role::all();
        
        return view('dashboards.index', [
            'degrees' => CollegeDegree::all(),
            'countries' => $countries,
            'user' => $user->load('details')
        ]);
    }
}
