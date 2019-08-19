<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

//    public function index()
//    {
//       return
//    }
    
    /**
     * Store a new role into DB.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $attributes = request()->validate([
                'name' => 'required|string|min:3|max:255|unique:roles,name',
                'label' => 'sometimes|string|min:3|max:255'
        ]);
        
        Role::create($attributes);
        
        return back();
    }
}
