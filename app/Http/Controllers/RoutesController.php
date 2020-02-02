<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutesController extends Controller
{
    
    public function show($lang)
    {
        if ($lang !== 'fa' && $lang !== 'en') {
            app()->setLocale('fa');
        } else {
            app()->setLocale($lang);
        }
        
        return redirect()->back();
    }
}
