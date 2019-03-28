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
           'services' => Service::latest()->get()
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

        request()->validate([
            'name' => 'required|min:3'
        ]);

       Service::create([
           'name' => request('name'),
           'owner_id' => auth()->id()
       ]);

       return redirect('dashboard/' . $user->name . '/services');
    }

    public function update(User $user, Service $service)
    {
        $attributes = request()->validate(['name' => 'required|min:3']);

        $service->update($attributes);

        return back();
    }

    public function destroy(User $user, Service $service)
    {
       $service->delete();

       return back();
    }
}
