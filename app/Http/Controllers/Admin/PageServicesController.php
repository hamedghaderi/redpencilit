<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PageService;
use App\Service;
use Illuminate\Http\Request;

class PageServicesController extends Controller
{
    
    public function store(PageService $pageService)
    {
        $attributes = request()->validate([
            'faTitle' => 'required|max:255',
            'faDescription' => 'required',
            'enTitle' => 'required|max:255',
            'enDescription' => 'required',
            'service-icon' => 'required|file|image|mimes:png,jpeg,jpg,svg|max:1024'
        ]);
        
        $fileName = \request()->file('service-icon')->hashName();
        
        auth()->user()->pageServices()->create([
            'title' => [
                'fa' => $attributes['faTitle'],
                'en' => $attributes['enTitle']
            ],
            'description' => [
                'fa' => $attributes['faDescription'],
                'en' => $attributes['enDescription']
            ],
            'path' => \request()->file('service-icon')->storeAs('/', $fileName, 'public'),
        ]);
        
        return back()->with('flash', __('Service created successfully.'));
    }
    
    /**
     * Show edit form to edit a service page
     *
     * @param $locale
     * @param  PageService  $pageService
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, PageService $pageService)
    {
        return view('admin.pages.edit-service', compact('pageService'));
    }
    
    public function update($locale, PageService $pageService)
    {
        $attributes = request()->validate([
            'faTitle' => 'required|max:255',
            'faDescription' => 'required',
            'enTitle' => 'required|max:255',
            'enDescription' => 'required',
            'service-icon' => 'bail|sometimes|file|image|mimes:png,jpeg,jpg,svg|max:1024'
        ]);
        
        if (request()->hasFile('service-icon')) {
            $fileName = \request()->file('service-icon')->hashName();
        }
        
        $pageService->update([
            'title' => [
                'fa' => $attributes['faTitle'],
                'en' => $attributes['enTitle']
            ],
            'description' => [
                'fa' => $attributes['faDescription'],
                'en' => $attributes['enDescription']
            ],
            'path' => request()->hasFile('service-icon')
                ?
                request()->file('service-icon')->storeAs('/', $fileName, 'public')
                :
                $pageService->path
        ]);
        
        return back()->with('flash', __('Service updated successfully.'));
    }
}
