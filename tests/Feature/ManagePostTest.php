<?php

namespace Tests\Feature;

use App\Permission;
use App\Post;
use App\Role;
use Illuminate\Support\Facades\Gate;
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
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $post = make(Post::class);
        
        $this->post('/posts', $post->toArray());
        
        $this->assertCount(1, Post::all());
    }
    
    /** @test * */
    public function a_writer_can_create_a_new_post()
    {
        $this->withoutExceptionHandling();
        
        $post = make(Post::class);
        
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'writer']);
        $permission = create(Permission::class, ['name' => 'create-posts']);
        $role->attachPermissions($permission);
        $user->addRole($role);
        
        Gate::define('create-posts', function ($user) use($permission) {
            return $user->hasRole($permission->roles);
        });
        
        $this->post('/posts', $post->toArray());
        
        $this->assertCount(1, Post::all());
    }
    
    /** @test * */
    public function a_post_requires_a_title()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $post = make(Post::class, ['title' => null]);
        
        $this->post('/posts', $post->toArray())
             ->assertSessionHasErrors('title');
    }
    
    /** @test * */
    public function a_post_requires_a_body()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $post = make(Post::class, ['body' => null]);
    
        
        $this->post('/posts', $post->toArray())
             ->assertSessionHasErrors('body');
    }
}
