<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_confirmation_email_is_sent_upon_confirmation()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        event(new Registered(create(User::class)));

        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }
    
    /** @test **/
    public function user_can_fully_confirm_their_email_address()
    {
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar',
            'phone' => '09369396387',
            'username' => 'john'
        ]);

        $user = User::whereName('John')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $response = $this->get('/register/emails?token=' .
        $user->confirmation_token);

        $this->assertTrue($user->fresh()->confirmed);

        $response->assertRedirect(route('new-order'));
    }
}
