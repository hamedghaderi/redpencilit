<?php

namespace Tests\Feature;

use App\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function an_authenticated_user_can_get_a_role()
    {
        $this->withoutExceptionHandling();
        
       $user = $this->signIn();
       
       $role = create(Role::class);
       
       $this->post("/users/{$user->username}/roles", [
           'role_id' => $role->id
       ]);
       
       $this->assertCount(1, $user->roles);
    }
}
