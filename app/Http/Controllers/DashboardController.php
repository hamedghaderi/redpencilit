<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(User $user)
    {
        if (auth()->user()->id != $user->id) {
            abort(403);
        }

        return view('dashboards.index');
    }
}
