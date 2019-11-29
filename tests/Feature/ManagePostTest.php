<?php

namespace Tests\Feature;

use App\Post;
use App\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManagePostTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test * */
    public function guests_cannot_create_a_post()
    {
        $this->post('/posts', [])->assertRedirect('/login');
    }
    
    /** @test * */
    public function an_authenticated_user_can_not_create_a_new_post()
    {
        $this->signIn();
        
        $post = make(Post::class);
        
        $this->post('/posts', $post->toArray())
             ->assertStatus(403);
    }
    
    /** @test * */
    public function an_admin_user_can_create_a_new_post()
    {
        $this->withoutExceptionHandling();
        $this->makeAdmin();
        
        $post = [
            'title' => 'My First Post',
            'body' => 'Body of the post.',
            'excerpt' => 'An excerpt with more than 20 characters'
        ];
        
        $this->post('/posts', $post);
        
        $this->assertCount(1, Post::all());
    }
    
    /** @test * */
    public function an_author_can_create_a_new_post()
    {
        $user = $this->signIn();
        $post = [
            'title' => 'My Post',
            'body' => 'Body of post.',
            'excerpt' => 'Post excerpt with more than 20 characters'
        ];
        $role = create(Role::class, ['name' => 'author']);
        
        $user->addRole($role);
        
        $this->post('/posts', $post);
        
        $this->assertCount(1, Post::all());
    }
    
    /** @test * */
    public function a_post_requires_a_title()
    {
        $this->makeAdmin();
        
        $post = make(Post::class, ['title' => null]);
        
        $this->post('/posts', $post->toArray())
             ->assertSessionHasErrors('title');
    }
    
    /** @test * */
    public function a_post_requires_an_excerpt()
    {
        $this->makeAdmin();
        
        $post = make(Post::class, ['excerpt' => null]);
        
        $this->post('/posts', $post->toArray())
            ->assertSessionHasErrors('excerpt');
    }
    
    /** @test * */
    public function a_post_requires_a_body()
    {
        $this->makeAdmin();
        
        $post = make(Post::class, ['body' => null]);
        
        $this->post('/posts', $post->toArray())
             ->assertSessionHasErrors('body');
    }
    
    /** @test * */
    public function a_user_can_visit_all_posts()
    {
        $post = create(Post::class);
        
        $this->get('/posts')
             ->assertSee($post->title)
             ->assertSee($post->description);
    }
    
    /** @test * */
    public function a_post_can_have_a_thumbnail_image()
    {
        $this->withoutExceptionHandling();
        $this->makeAdmin();
        
        Storage::fake('public');
        $post = [
            'title' => 'My Post',
            'body' => 'Body of post.',
            'excerpt' => 'Post excerpt with more than 20 characters',
            'thumbnail' => $thumb = UploadedFile::fake()->image('test.jpg')
        ];
        
        $this->post('/posts', $post);
        
        Storage::disk('public')->assertExists('blog/'.$thumb->hashName());
        
        $this->assertDatabaseHas('posts', ['thumbnail' => 'blog/'.$thumb->hashName()]);
    }
    
    /** @test * */
    public function a_thumbnail_should_be_a_valid_image()
    {
        $this->makeAdmin();
        
        Storage::fake('public');
        
        $post = make(
            Post::class, [
            'thumbnail' => $thumb = UploadedFile::fake()->create('test.pdf'),
        ]);
        
        $this->post('/posts', $post->toArray())
             ->assertSessionHasErrors('thumbnail');
    }
    
    /** @test * */
    public function a_user_can_see_a_single_post()
    {
        $this->withoutExceptionHandling();
        
        $post = create(Post::class);
        
        $this->get($post->path())
             ->assertSee($post->title)
             ->assertSee($post->body);
    }
    
    /** @test * */
    public function admin_can_update_a_post()
    {
        $this->makeAdmin();
        
        Storage::fake('public');
        
        $post = create(Post::class);
        
        $this->patch($post->path(), [
            'title' => 'Hello',
            'body' => 'Bye Father',
            'excerpt' => 'Hello There. This is my first post.',
            'thumbnail' => $file = UploadedFile::fake()->image('another_image.jpg')
        ])->assertRedirect($post->path());
        
        $this->assertDatabaseHas('posts', [
            'title' => 'Hello',
            'excerpt' => 'Hello There. This is my first post.',
            'body' => 'Bye Father',
            'thumbnail' => 'blog/'.$file->hashName()
        ]);
    }
   
    /** @test * */
    public function admin_can_delete_a_post()
    {
        $this->withoutExceptionHandling();
        
        $this->makeAdmin();
        
        $post = create(Post::class);
        
        self::assertCount(1, Post::all());
        
        $this->delete($post->path());
        
        $this->assertCount(0, Post::all());
    }
    
    /** @test **/
    public function author_can_delete_a_post()
    {
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'author']);
        $post = create(Post::class);
        $user->addRole($role);
    
        $this->assertCount(1, Post::all());
    
        $this->delete($post->path());
    
        $this->assertCount(0, Post::all());
    }
}
