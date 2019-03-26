<?php

namespace App\Http\Controllers;

use App\Service;

class ServicesController extends Controller
{
    public function index()
    {
       return view('services.index', [
           'services' => Service::all()
       ]);
    }
    public function create()
    {
       return view('services.create');
    }

    public function store()
    {
       Service::create([
           'name' => request('name')
       ]);

       return redirect('dashboard/services');
    }
}
