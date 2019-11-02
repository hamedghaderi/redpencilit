<?php

namespace App\Http\Controllers;

use App\Testimonial;
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
    
    public function homepage()
    {
        $testimonials = Testimonial::with('comment')
                                   ->latest()
                                   ->take(5)
                                   ->get();
        
       return view('welcome', compact('testimonials'));
    }
    
    /**
     * Store a new comment into DB.
     */
    public function store()
    {
       $attributes = request()->validate([
           'name' => 'required',
           'email' => 'required|email',
           'message' => 'required|min:3'
       ]);
      
      Mail::send('email', [
          'name' => \request('name'),
          'email' => request('email'),
          'user_message' => request('message')
      ], function ($message) {
          $message->from(request('name'));
          $message->to('hamedghaderii@gmail.com', 'Super Admin')->subject('Contact Email');
          
          return back()->with('flash', 'از پیام شما متشکریم.');
      });
    }
}
