<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikePostsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function an_authenticated_user_can_like_a_post()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();
        
        $post = create(Post::class);
        
        $this->post($post->path() . '/favorite');
        
        $this->assertCount(1, $post->favorites);
    }
    
    /** @test **/
    public function a_user_can_disfavorate_a_post()
    {
       $this->signIn();
       
       $post = create(Post::class);
    
        $this->post($post->path() . '/favorite');
    
        $this->assertCount(1, $post->fresh()->favorites);
       
       $this->delete($post->path() . '/disfavor');
       
       $this->assertCount(0, $post->fresh()->favorites);
    }
    
    /** @test **/
    public function it_can_get_find_out_if_it_is_favorited_by_current_user()
    {
        $this->signIn();
    
        $post = create(Post::class);
    
        $this->post($post->path() . '/favorite');

        $this->assertEquals(1, $post->isFavorited());

        $this->delete($post->path() . '/disfavor');

        $this->assertEquals(0, $post->fresh()->isFavorited());
    }
}
