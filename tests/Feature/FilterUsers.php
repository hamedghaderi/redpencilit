<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterUsers extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function an_admin_can_filter_users_by_coworkers()
    {
        $this->withoutExceptionHandling();
        
        $admin = $this->makeAdmin();
        $editor = create(User::class);
        $role = create(Role::class, ['name' => 'editor']);
        $editor->addRole($role);
        
        $strangers = create(User::class, [], 10);
        
        $this->get('/users?type=coworkers')
             ->assertSee($editor->name)
             ->assertDontSee($strangers[0]->name);
    }
    
    /** @test * */
    public function an_admin_can_filter_users_by_just_customers()
    {
        $this->withoutExceptionHandling();
    
        $admin = $this->makeAdmin();
        $editor = create(User::class);
        $role = create(Role::class, ['name' => 'editor']);
        $editor->addRole($role);
    
        $strangers = create(User::class, [], 10);
    
        $this->get('/users?type=customers')
             ->assertSee($strangers[0]->name)
            ->assertSee($strangers[9]->name)
             ->assertDontSee($editor->name);
    }
}
