<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function a_user_can_register_with_a_new_account()
    {
        $this->withoutExceptionHandling();
        
        $user = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'phone' => '09369396387'
        ];
        
        $response = $this->json('post', route('register', app()->getLocale()), $user);
        
        $response->assertStatus(201)
                 ->assertJson(['name' => 'John Doe'])
                 ->assertJsonMissing(['password']);
    }
    
    /** @test * */
    public function the_first_user_who_register_has_the_role_of_admin()
    {
        $this->withoutExceptionHandling();
        
        Mail::fake();
        
        $user = make(User::class);
        
        $user->password_confirmation = $user->password;
        
        $response = $this->postJson(
            route('register', app()->getLocale()),
            $user->makeVisible('password')->makeVisible('email')->toArray()
        );
        
        $user = User::first();
        $this->assertCount(1, $user->roles);
        $this->assertDatabaseHas('users', ['name' => $user->name]);
        
        $this->assertTrue($user->isSuperAdmin());
    }
    
    /** @test * */
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
        $this->assertFalse($user->isSuperAdmin());
    }
}
