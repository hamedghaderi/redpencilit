<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function a_user_can_register_with_a_new_account()
    {
        $user = make(User::class);
        $user->password_confirmation = $user->password;
        
        $response = $this->postJson(
            '/register',
            $user->makeVisible('password')->makeVisible('email')->toArray()
        );
        
        $this->assertEquals(200, $response->json()['status']);
        
        $response->assertJsonFragment(['name' => $user->name]);
    }
    
    /** @test * */
    public function the_first_user_who_register_has_the_role_of_admin()
    {
        $user = make(User::class);
        $user->password_confirmation = $user->password;
        
        $response = $this->postJson('/register', $user->makeVisible('password')->makeVisible('email')->toArray());
        $user = User::first();
        $this->assertCount(1, $user->roles);
        
        $this->assertDatabaseHas('users', ['name' => $user->name]);
        
        $this->assertTrue($user->isAdmin());
    }
    
    /** @test **/
    public function the_second_user_has_not_any_roles()
    {
        
        /*
        |--------------------------------------------------------------------------
        | First User
        |--------------------------------------------------------------------------
        */
        create(User::class);
        
        
        /*
        |--------------------------------------------------------------------------
        | Second User
        |--------------------------------------------------------------------------
        */ 
        $user = make(User::class, ['name' => 'John']);
        $user->password_confirmation = $user->password;
    
        $response = $this->json('post', '/register', $user->makeVisible('password')->makeVisible('email')->toArray());
        $user = User::first();
        $this->assertCount(0, $user->roles);
    
        $this->assertDatabaseHas('users', ['name' => $user->name]);
        $this->assertFalse($user->isAdmin());
       
    }
}
