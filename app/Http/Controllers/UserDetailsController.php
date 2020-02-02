<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    /**
     * Create details for a user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $attributes = request()->validate([
            'degree_id' => 'sometimes|nullable|exists:college_degrees,id',
            'college' => 'sometimes|nullable|min:3|max:255',
            'country_id' => 'sometimes|nullable|exists:countries,id',
            'field' => 'sometimes|nullable|min:3|max:255',
            'address' => 'sometimes|nullable|min:3|max:255',
            'gender' => 'sometimes|nullable|boolean',
        ]);
        
        auth()->user()->details()->create($attributes);
        
        return redirect(route('dashboard', [$locale, auth()->id()]));
    }
    
    public function update($locale, User $user)
    {
        $attributes = request()->validate([
            'degree_id' => 'sometimes|nullable|exists:college_degrees,id',
            'college' => 'sometimes|nullable|min:3|max:255',
            'country_id' => 'sometimes|nullable|exists:countries,id',
            'field' => 'sometimes|nullable|min:3|max:255',
            'address' => 'sometimes|nullable|min:3|max:255',
            'gender' => 'sometimes|nullable|boolean' ,
        ]);
        
       $user->details()->update($attributes);
        
        return back()->with('flash', 'اطلاعات شما با موفقیت ثبت شد.');
    }
}
