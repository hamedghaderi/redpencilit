<?php

namespace App\Http\Controllers;

use App\Comment;

class TestimonialsController extends Controller
{
    
    /**
     * Create a new testimonial.
     *
     * @param           $locale
     * @param  Comment  $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store($locale, Comment $comment)
    {
        $attributes = request()->validate([
            'body' => 'required|min:5|max:100'
        ]);
        
        $attributes['author_id'] =  auth()->id();
        
        $comment->testimonial()->create($attributes);
        
        return response('با موفقیت به صفحه اصلی اضافه شد.', 200);
    }
}
