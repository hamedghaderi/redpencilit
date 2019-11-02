<?php

namespace Tests\Unit;

use App\Comment;
use App\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function a_comment_can_have_one_testimonial()
    {
        $this->withoutExceptionHandling();
        
       $comment = create(Comment::class);
       
       $testimonial = create(Testimonial::class, ['comment_id' => $comment->id]);
       
       $this->assertInstanceOf(Comment::class, $testimonial->comment);
    }
}
