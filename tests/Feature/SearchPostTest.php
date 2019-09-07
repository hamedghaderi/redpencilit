<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchPostTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function a_user_can_search_for_a_specific_content_inside_posts()
    {
        $this->withoutExceptionHandling();
        
       $post = create(Post::class, ['title' => 'Hello there.']);
       create(Post::class, [], 100);
       
       $this->get('/posts?q=there')
           ->assertSee('Hello there.');
    }
}
