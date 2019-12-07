<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;

class ServicesController extends Controller
{
    /**
     * Get all services
     *
     * @param        $locale
     * @param  User  $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index($locale, User $user)
    {
        $this->authorize('update', new Service());
        
        if (request()->wantsJson()) {
            return Service::latest()->get();
        }
        
        return view(
            'services.index', [
            'services' => Service::latest()->get()
        ]);
    }
    
    /**
     * show a form for creating a user
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($locale, User $user)
    {
        $this->authorize('update', new Service());
        
        return view('services.create');
    }
    
    /**
     * Persist new service into DB.
     *
     * @param        $locale
     * @param  User  $user
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($locale, User $user)
    {
        $this->authorize('update', new Service());
        
        $attributes = request()->validate(
            [
                'name' => 'required|min:3',
            ]);
        
        $attributes['negotiable'] = request()->has('negotiable')
                                    && request('negotiable');
        
        $service = auth()->user()->services()->create($attributes);
        
        if (request()->wantsJson()) {
            return [
                'service' => $service,
                'status' => 200
            ];
        }
        
        return redirect(route('services.index', $locale));
    }
    
    /**
     * Show a single service to admin.
     *
     * @param           $locale
     * @param  User     $user
     * @param  Service  $service
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($locale, User $user, Service $service)
    {
        $this->authorize('update', $service);
        
        return response(
            [
                'status' => 200,
                'service' => $service
            ]);
    }
    
    /**
     * Update a service with the given id.
     *
     * @param           $locale
     * @param  User     $user
     * @param  Service  $service
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($locale, User $user, Service $service)
    {
        $this->authorize('update', $service);
        
        $attributes = request()->validate(
            [
                'name' => 'required|min:3',
            ]);
        
        $attributes['negotiable'] = request()->has('negotiable')
                                    && request('negotiable');
        
        $service->update($attributes);
        
        if (request()->wantsJson()) {
            return response()->json(
                [
                    'status' => 200,
                ]);
        }
        
        return redirect(route('services.index', $locale));
    }
    
    /**
     * Delete a specific service
     *
     * @param           $locale
     * @param  Service  $service
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($locale, Service $service)
    {
        $this->authorize('update', $service);
        
        $service->delete();
        
        if (request()->wantsJson()) {
            return Service::latest()->get();
        }
        
        return redirect(route('services.index', $locale));
    }
}
