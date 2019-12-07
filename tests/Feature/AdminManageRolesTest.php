<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminManageRolesTest extends TestCase
{
    
    use DatabaseMigrations;
    
    /** @test * */
    public function admin_can_add_role_to_a_user()
    {
        $user = $this->makeAdmin();
        
        $admin = create(Role::class, ['name' => 'admin']);
        $author = create(Role::class, ['name' => 'author']);
        $basic = create(Role::class, ['name' => 'basic']);
        $john = create(User::class);
        
        $this->patch(
            route('admin.users.patch', [app()->getLocale(), $john]), [
            'roles' => [$author->id, $basic->id]
        ]);
        
        $this->assertCount(2, $john->roles);
        $this->assertTrue($john->roles->pluck('id')->contains($author->id));
        $this->assertTrue($john->roles->pluck('id')->contains($basic->id));
        $this->assertFalse($john->roles->pluck('id')->contains($admin->id));
    }
    
    /** @test **/
    public function admin_can_get_all_roles_from_a_user()
    {
        $user = $this->makeAdmin();
    
        $admin = create(Role::class, ['name' => 'admin']);
        $author = create(Role::class, ['name' => 'author']);
        $basic = create(Role::class, ['name' => 'basic']);
        
        $john = create(User::class);
        
        $john->addRole($author);
        $john->addRole($basic);
    
        $this->patch(
            route('admin.users.patch', [app()->getLocale(), $john]), [
            'roles' => []
        ]);
    
        $john = $john->fresh();
        
        $this->assertCount(0, $john->roles);
        $this->assertFalse($john->roles->pluck('id')->contains($author->id));
        $this->assertFalse($john->roles->pluck('id')->contains($basic->id));
        $this->assertFalse($john->roles->pluck('id')->contains($admin->id));
    }
}
