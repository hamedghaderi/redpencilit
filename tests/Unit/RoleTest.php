<?php

namespace Tests\Unit;

use App\Permission;
use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function it_can_attach_permissions()
    {
        $this->withoutExceptionHandling();
        
        $role = create(Role::class);
        
        $permission = create(Permission::class);
        
        $role->attachPermissions($permission);
        
        $this->assertCount(1, $role->permissions);
    }
}
