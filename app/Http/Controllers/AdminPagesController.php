<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Str;

class AdminPagesController extends Controller
{
    
    public function index()
    {
        return view('admin.pages.index');
    }
    
    public function home()
    {
       $page = Page::where('name', 'home')->first();
       
       return view('admin.pages.home', compact('page'));
    }
    
    public function homeUpdate()
    {
       $page = Page::firstOrCreate(['name' => 'home']);
       
       $data = [
           'fa' => [],
           'en' => []
       ];
       
       foreach(request()->all() as $key =>  $value) {
           if (Str::startsWith($key, 'fa')) {
               $key = str_ireplace('fa', '', $key);
               $data['fa'][$key] = $value;
           } elseif (Str::startsWith($key, 'en')) {
               $key = str_ireplace('en', '', $key);
               $data['en'][$key] = $value;
           }
       }
       $page->data = $data;
       $page->save();
       
       return back();
    }
}
