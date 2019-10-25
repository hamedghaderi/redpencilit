<?php

namespace Tests\Feature;

use App\Permission;
use App\Post;
use App\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagePostTest extends TestCase
{
    
    use RefreshDatabase;
    
    protected function setUp()
    {
        parent::setUp();
    }
    
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
        
        $post = make(Post::class);
        
        $this->post('/posts', $post->toArray());
        
        $this->assertCount(1, Post::all());
    }
    
    /** @test * */
    public function a_writer_can_create_a_new_post()
    {
        $post = make(Post::class);
        
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'writer']);
        $permission = create(Permission::class, ['name' => 'create-posts']);
        $role->attachPermissions($permission);
        $user->addRole($role);
        
        Gate::define(
            'create-posts', function ($user) use ($permission) {
            return $user->hasRole($permission->roles);
        });
        
        $this->post('/posts', $post->toArray());
        
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
        
        $post = make(
            Post::class, [
            'thumbnail' => $thumb = UploadedFile::fake()->image('test.jpg'),
        ]);
        
        $this->post('/posts', $post->toArray());
        
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
        
        $this->patch(
            $post->path(), [
            'title' => 'Hello',
            'body' => 'Bye Father',
            'excerpt' => 'Hello There. This is my first post.',
            'thumbnail' => $file = UploadedFile::fake()->image('another_image.jpg')
        ])->assertRedirect($post->path());
        
        $this->assertDatabaseHas(
            'posts', [
            'title' => 'Hello',
            'excerpt' => 'Hello There. This is my first post.',
            'body' => 'Bye Father',
            'thumbnail' => 'blog/'.$file->hashName()
        ]);
    }
    
    /** @test * */
    public function a_user_can_delete_a_post()
    {
        $this->withoutExceptionHandling();
        
        $this->makeAdmin();
        
        $post = create(Post::class);
        
        self::assertCount(1, Post::all());
        
        $this->delete($post->path());
        
        $this->assertCount(0, Post::all());
    }
}
