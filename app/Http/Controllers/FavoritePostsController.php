<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FavoritePostsController extends Controller
{
    
    /**
     * Favorite a post.
     *
     * @param        $locale
     * @param  Post  $post
     */
    public function store($locale, Post $post)
    {
       auth()->user()->favorites()->attach($post->id);
    }
    
    /**
     * Disfavor a post.
     *
     * @param        $locale
     * @param  Post  $post
     */
    public function destroy($locale, Post $post)
    {
        auth()->user()->favorites()->detach($post->id);
    }
}
