<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function it_has_a_path()
    {
        $post = create(Post::class);
        
        $this->assertEquals('/posts/'.$post->id, $post->path());
    }
    
    /** @test * */
    public function it_has_an_owner()
    {
        $post = create(Post::class);
        
        $this->assertInstanceOf(User::class, $post->owner);
    }
    
    /** @test * */
    public function a_post_body_is_sanitized_automatically()
    {
        $post = make(Post::class, ['body' => '<script>alert("bad");</script>']);
        
        $this->assertEmpty($post->body);
    }
}
