<?php

namespace Tests\Feature;

use App\Permission;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{   
    use RefreshDatabase;
    
    /** @test **/
    public function a_user_can_create_a_role()
    {
        $role = make(Role::class);
        
        $this->post('/roles', $role->toArray());
        
        $this->assertDatabaseHas('roles', ['name' => $role->name, 'label' => $role->label]);
    }
    
    /** @test **/
    public function a_role_requires_a_name()
    {
       $role = make(Role::class, ['name' => null]);
       
       $this->post('/roles', $role->toArray())
           ->assertSessionHasErrors(['name']);
    }
    
    /** @test **/
    public function a_role_name_should_be_unique()
    {
       $role = create(Role::class, ['name' => 'Admin']);
       
       $role = make(Role::class, ['name' => 'Admin']);
       
       $this->post('/roles', $role->toArray())
           ->assertSessionHasErrors(['name']);
    }
    
    /** @test **/
    public function it_may_has_permissions()
    {
       $this->withoutExceptionHandling() ;
       
       $role = create(Role::class);
       $permission = create(Permission::class);
       
       $role->permissions()->attach($permission);
       
       $this->assertCount(1, $role->permissions);
    }
    
    /** @test **/
    public function we_can_add_permissions_to_a_role()
    {
        $this->withoutExceptionHandling();
        
       $role = create(Role::class);
       $permissions = create(Permission::class, [], 3);
       
       $role->attachPermissions($permissions);
       
       $this->assertCount(3, $role->fresh()->permissions);
    }
}
