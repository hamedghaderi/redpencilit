<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string|min:3|max:255|unique:permissions,name',
            'label' => 'sometimes|string|min:3|max:255'
        ]);
        
        Permission::create($attributes);
        
        return back();
    }
}
