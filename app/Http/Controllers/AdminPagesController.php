<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageService;
use Illuminate\Support\Str;

class AdminPagesController extends Controller
{
    
    /**
     * Show link of all updateable pages
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.index');
    }
    
    /**
     * Show a form to set home page data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $page = Page::where('name', 'home')->first();
        
        return view('admin.pages.home', compact('page'));
    }
    
    /**
     *  Show a form to set home page data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        $page = Page::where('name', 'about')->first();
        
        return view('admin.pages.about', compact('page'));
    }
    
    /**
     * show a form to set contact page data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $page = Page::where('name', 'contact')->first();
        
        return view('admin.pages.contact', compact('page'));
    }
    
    public function services()
    {
        $services = PageService::all();
        
        return view('admin.pages.services', compact('services'));
    }
    
    /**
     * Update home page data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function homeUpdate()
    {
        $this->updatePage('home');
        
        return back();
    }
    
    /**
     * Update about page data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function aboutUpdate()
    {
        $this->updatePage('about');
        
        return back();
    }
    
    /**
     * Update contact page data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUpdate()
    {
        $this->updatePage('contact');
        
        return back();
    }
    
    
    /**
     * Save updated data into DB.
     *
     * @param $pageName
     */
    protected function updatePage($pageName): void
    {
        $page = Page::firstOrCreate(['name' => $pageName]);
        
        $data = [
            'fa' => [],
            'en' => []
        ];
        
        foreach (request()->all() as $key => $value) {
            $slicedKey = substr($key, 2, strlen($key));
            
            Str::startsWith($key, 'fa')
                ? $data['fa'][$slicedKey] = $value
                : $data['en'][$slicedKey] = $value;
        }
        
        $page->data = $data;
        $page->save();
    }
}
