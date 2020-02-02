<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    
    /**
     * Show the list of all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::select('*');
        
        if (request()->has('q')) {
            $posts = $posts->search(request('q'));
        }
        
        $posts = $posts->take(1000)->latest()->paginate(25);
        
        return view(
            'posts.index', [
            'posts' => $posts
        ]);
    }
    
    /**
     * Show a single post.
     *
     * @param        $locale
     * @param  Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, Post $post)
    {
        return view('posts.show', compact('post'));
    }
    
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
        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'excerpt' => 'required|min:20|max:255',
            'body' => 'required|min:5',
            'thumbnail' => 'sometimes|file|image|max:1024'
        ]);
        
        if (request()->has('thumbnail')) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('blog', 'public');
        }
        
        auth()->user()->posts()->create($attributes);
        
        return back();
    }
    
    /**
     * Show edit form for post.
     *
     * @param  Post  $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($locale, Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    
    /**
     * Update the given post.
     *
     * @param        $locale
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($locale, Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'excerpt' => 'required|min:20|max:255',
            'body' => 'required|min:5',
            'thumbnail' => 'sometimes|file|image|max:1024'
        ]);
    
        if (request()->has('thumbnail')) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('blog', 'public');
        }
        
        $post->update($attributes);
        
        return redirect(route('posts.show', [app()->getLocale(), $post]));
    }
    
    /**
     * Delete the given post.
     *
     * @param        $locale
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($locale, Post $post)
    {
        $post->delete();
        
        return back();
    }
}
