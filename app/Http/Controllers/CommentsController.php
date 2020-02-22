<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Mail\CommentMessage;
use App\Testimonial;
use App\User;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    
    /**
     * Get the list of all comments.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(5);
        
        $testimonials = Testimonial::with('comment')->latest()->paginate(5);
        
        return view('comments.index', [
            'comments' => $comments,
            'testimonials' => $testimonials
        ]);
    }
    
    /**
     * Persist a new comment into DB.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate(
            [
                'name' => 'required|min:3|max:255|string',
                'email' => 'required|email',
                'message' => 'required|min:5',
                'rate' => 'bail|sometimes|numeric|gte:1|lte:5'
            ]);
        
        $comment = Comment::create($attributes);
        
        Mail::to(User::superAdmin()->first())
            ->send(new CommentMessage($comment));
        
        return response('پیام شما با موفقیت ارسال شد. ', 200);
    }
    
    /**
     * Delete a comment if exists.
     *
     * @param           $locale
     * @param  Comment  $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy($locale, Comment $comment)
    {
        $comment->delete();
        
        return response('با موفقیت حذف شد.', 200);
    }
}
