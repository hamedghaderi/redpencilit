<?php

namespace Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_confirmation_email_is_sent_upon_confirmation()
    {
        $this->withoutExceptionHandling();

        Mail::fake();

        event(new Registered(create(User::class)));

        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /** @test * */
    public function users_can_fully_confirm_their_email_address()
    {
        $this->withoutExceptionHandling();

        $this->post(route('register', app()->getLocale()), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar',
            'phone_number' => '09369396387',
            'username' => 'john'
        ]);

        $user = User::whereName('John')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $response = $this->get(route('register.email.token', app()->getLocale()) . '?token=' . $user->confirmation_token);

        $this->assertTrue($user->fresh()->confirmed);

        $response->assertRedirect(route('new-order', app()->getLocale()));
    }
}
