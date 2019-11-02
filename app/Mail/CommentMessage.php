<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentMessage extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * @var Comment
     */
    public $comment;
    
    /**
     * Create a new message instance.
     *
     * @param  Comment  $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('نظرات کاربران')->markdown('emails.comment');
    }
}
