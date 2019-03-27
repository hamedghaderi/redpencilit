<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;

class ServicesController extends Controller
{
    public function index(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

       return view('services.index', [
           'services' => Service::all()
       ]);
    }
    public function create(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

       return view('services.create');
    }

    public function store(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

       Service::create([
           'name' => request('name'),
           'owner_id' => auth()->id()
       ]);

       return redirect('dashboard/' . $user->name . '/services');
    }
}
