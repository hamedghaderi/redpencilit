<?php

namespace App\Http\Controllers;

use App\Page;
use App\PageService;
use App\Testimonial;
use App\User;
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
        $about = Page::where('name', 'about')->first();

        return view('pages.about', ['about' => $about]);
    }

    /**
     *  Contact Us Page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $contact = Page::where('name', 'contact')->first();

        return view('pages.contact', compact('contact'));
    }

    /**
     * Show homepage view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage()
    {
        $home = Page::where('name', 'home')->first();
        $authorAvatar = User::select('avatar')->superAdmin()->first()
            ?: asset('images/profile.png.jpg');
        $testimonials = Testimonial::with('comment')
            ->latest()
            ->take(5)
            ->get();

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
        $services = PageService::all();

        return view('pages.service', ['services' => $services]);
    }
}
