<?php

namespace App\Http\Controllers;

class PostAttachmentsController extends Controller
{
    
    /**
     * Store a new blog post image.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws UploadException
     */
    public function store()
    {
        \request()->validate([
            'key' => 'required|string|max:255|min:3',
            'attachment' => 'required|image|max:1024'
        ]);
        
        $file = \request()->file('attachment');
        
        $file_path = \request()->file('attachment')->storeAs(
            'blog',
            request('key'),
            'public'
        );
        
        return response($file_path, 200);
    }
}
