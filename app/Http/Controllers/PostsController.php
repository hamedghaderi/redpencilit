<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    
    /**
     * Show a form to create a new post.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * Store a new post into DB.
     */
    public function store()
    {
        auth()->user()->posts()->create(
            request()->validate(
                [
                    'title' => 'required|min:3|max:255',
                    'body' => 'required|min:5'
                ])
        );
        
        return back();
    }
}
