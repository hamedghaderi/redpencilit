<?php

namespace Tests\Feature;

use App\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function super_admin_can_make_a_new_testimonial_from_comments()
    {
        $this->withoutExceptionHandling();
        
        $this->makeAdmin();
        
        $comment = create(Comment::class);
        
        $this->post('/comments/' . $comment->id . '/testimonials', [
            'body' => 'Hello There.'
        ]);
        
        $this->assertDatabaseHas('testimonials', [
            'body' => 'Hello There.',
            'comment_id' => $comment->id
        ]);
        
        $this->assertEquals(1, $comment->testimonial->count());
    }
    
    /** @test **/
    public function other_users_can_not_make_testimonials()
    {
        $comment = create(Comment::class);
        
        $this->signIn();
    
        $this->post('/comments/' . $comment->id . '/testimonials', [
            'body' => 'Hello There.'
        ])->assertStatus(403);
    }
}
