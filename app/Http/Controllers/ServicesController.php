<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;

class ServicesController extends Controller
{
    /**
     * Get all services
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

        if (request()->wantsJson()) {
            return Service::latest()->get();
        }

       return view('services.index', [
           'services' => Service::latest()->get()
       ]);
    }

    /**
     * show a form for creating a user
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

       return view('services.create');
    }

    /**
     * Persist new service into DB.
     *
     * @param  User  $user
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(User $user)
    {
        if ($user->id != auth()->user()->id) {
            abort(403);
        }

        $attributes = request()->validate([
            'name' => 'required|min:3',
        ]);

        $attributes['negotiable'] = request()->has('negotiable') && request('negotiable');

        $service = auth()->user()->services()->create($attributes);

        if (request()->wantsJson()) {
            return [
                'service' => $service,
                'status' => 200
            ];
        }

       return redirect('dashboard/' . $user->username . '/services');
    }

    public function show(User $user, Service $service)
    {
       return response([
           'status' => 200,
           'service' => $service
       ]);
    }

    /**
     * Update a service with the given id.
     *
     * @param  User  $user
     * @param  Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, Service $service)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
        ]);

        $attributes['negotiable'] = request()->has('negotiable') && request('negotiable');

        $service->update($attributes);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 200,
            ]);
        }

        return back();
    }

    public function destroy(User $user, Service $service)
    {
       $service->delete();

       if (request()->wantsJson()) {
           return Service::latest()->get();
       }

       return back();
    }
}
