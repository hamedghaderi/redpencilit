<?php

namespace App\Http\Controllers;

use App\Page;
use App\Testimonial;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    
    /**
     * About Us Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('pages.about');
    }
    
    /**
     *  Contact Us Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }
    
    /**
     * Show homepage view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage()
    {
        $testimonials = Testimonial::with('comment')
                                   ->latest()
                                   ->take(5)
                                   ->get();
        
        $home = Page::where('name', 'home')->first();
        $admin = User::superAdmin()->first();
        
        $authorAvatar = ($admin && $admin->avatar) ? $admin->avatar : asset('images/profile.png.jpg');

        return view('welcome', compact('testimonials', 'authorAvatar', 'home'));
    }
    
    /**
     * Store a new comment into DB.
     */
    public function store()
    {
        $attributes = request()->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:3'
            ]);
        
        Mail::send(
            'email', [
            'name' => \request('name'),
            'email' => request('email'),
            'user_message' => request('message')
        ], function ($message) {
            $message->from(request('name'));
            $message->to('hamedghaderii@gmail.com', 'Super Admin')->subject('Contact Email');
            
            return back()->with('flash', 'از پیام شما متشکریم.');
        });
    }
    
    public function service()
    {
       return view('pages.service');
    }
}
