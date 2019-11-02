<?php

namespace App\Http\Controllers;

use App\Comment;

class TestimonialsController extends Controller
{
    
    public function store(Comment $comment)
    {
        $attributes = request()->validate([
            'body' => 'required|min:5|max:100'
        ]);
        
        $attributes['author_id'] =  auth()->id();
        
        $comment->testimonial()->create($attributes);
        
        return response('با موفقیت به صفحه اصلی اضافه شد.', 200);
    }
}
