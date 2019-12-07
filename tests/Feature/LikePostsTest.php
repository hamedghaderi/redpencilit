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
        
        $this->post(route('favorite.store', [app()->getLocale(), $post]));
        
        $this->assertCount(1, $post->favorites);
    }
    
    /** @test **/
    public function a_user_can_disfavorate_a_post()
    {
       $this->signIn();
       
       $post = create(Post::class);
    
        $this->post(route('favorite.store', [app()->getLocale(), $post]));
    
        $this->assertCount(1, $post->fresh()->favorites);
       
       $this->delete(route('favorite.destroy', [app()->getLocale(), $post]));
       
       $this->assertCount(0, $post->fresh()->favorites);
    }
    
    /** @test **/
    public function it_can_get_find_out_if_it_is_favorited_by_current_user()
    {
        $this->signIn();
    
        $post = create(Post::class);
    
        $this->post(route('favorite.store', [app()->getLocale(), $post]));

        $this->assertEquals(1, $post->isFavorited());

        $this->delete(route('favorite.destroy', [app()->getLocale(), $post]));

        $this->assertEquals(0, $post->fresh()->isFavorited());
    }
}
