<?php

namespace Tests\Feature;

use App\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function a_user_can_create_a_permission()
    {
        $this->withoutExceptionHandling();
        
        $permission = make(Permission::class);
        
        $this->post('/permissions', $permission->toArray());
        
        $this->assertDatabaseHas('permissions', ['name' => $permission->name, 'label' => $permission->label]);
    }
    
    /** @test * */
    public function a_permission_requires_a_name()
    {
        $permission = make(Permission::class, ['name' => null]);
        
        $this->post('/permissions', $permission->toArray())
            ->assertSessionHasErrors(['name']);
    }
    
    /** @test **/
    public function a_permission_name_should_be_unique()
    {
       $permission = create(Permission::class, ['name' => 'admin']) ;
       
       $otherPermission = make(Permission::class, ['name' => 'admin']);
       
       $this->post('/permissions', $permission->toArray())
           ->assertSessionHasErrors(['name']);
    }
}
