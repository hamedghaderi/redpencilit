<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminTest extends TestCase
{
    
    use DatabaseMigrations;
    
    /** @test * */
    public function an_admin_can_delete_a_user()
    {
        $this->withoutExceptionHandling();
        
        $admin = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $admin->addRole($role);
        
        $john = create(User::class, ['name' => 'John']);
        
        $this->assertCount(2, User::all());
        
        $this->delete(route('admin.users.destroy', [app()->getLocale(), $john]))
             ->assertRedirect(route('admin.users.index', app()->getLocale()));
        
        $this->assertCount(1, User::all());
    }
    
    /** @test * */
    public function guests_cannot_delete_a_user()
    {
        $user = create(User::class);
        
        $this->delete(route('admin.users.destroy', [app()->getLocale(), $user]))
             ->assertRedirect(route('login', app()->getLocale()));
    }
    
    /** @test * */
    public function authenticated_users_can_not_delete_another_user()
    {
        $john = $this->signIn();
        
        $david = create(User::class);
        
        $this->delete(route('admin.users.destroy', [app()->getLocale(), $david]))
             ->assertStatus(403);
    }
    
    /** @test * */
    public function an_admin_can_see_the_list_of_all_users()
    {
        $this->withoutExceptionHandling();
        
        $admin = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        $admin->addRole($role);
        
        $john = create(User::class, ['name' => 'John']);
        
        $this->get(route('admin.users.index', app()->getLocale()))
             ->assertSee('John');
    }
}
