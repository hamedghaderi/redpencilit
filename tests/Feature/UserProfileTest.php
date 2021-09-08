<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
   use RefreshDatabase;

   /** @test **/
   public function users_can_update_their_profile()
   {
       $this->withoutExceptionHandling();

      $user = $this->signIn(
          User::factory()->create([
              'name' => 'Jane',
              'email' => 'jane@doe.com',
              'phone' => '09369396387'
          ])
      );

       $attributes = [
           'name' => 'John',
           'email' => 'john@doe.com',
           'phone' => '09360000000'
       ];

       $this->patch(route('dashboard.user.update', [app()->getLocale(), $user]), $attributes);

      $this->assertDatabaseHas('users', $attributes);
   }

   /** @test **/
   public function guests_cannot_update_user_information()
   {
       $this->patch(route('dashboard.user.update', [app()->getLocale(), 1]))
            ->assertRedirect(route('login', app()->getLocale()));
   }

   /** @test **/
    public function update_user_account_requires_valid_phone_number()
    {
        $user = $this->signIn();

        $this->patch(route('dashboard.user.update', ['fa', $user]), ['phone' => ''])
            ->assertSessionHasErrors('phone');
    }

    /** @test **/
    public function update_user_account_requires_valid_email_address()
    {
        $user = $this->signIn();

        $this->patch(route('dashboard.user.update', ['fa', $user]), ['email' => ''])
            ->assertSessionHasErrors('email');
    }

    /** @test **/
    public function email_should_be_a_valid_email_for_update()
    {
       $user = $this->signIn();

        $this->patch(route('dashboard.user.update', ['fa', $user]), ['email' => 'johasdfasdf'])
             ->assertSessionHasErrors('email');
    }

    /** @test **/
    public function updating_a_user_requires_a_name()
    {
        $user = $this->signIn();

        $this->patch(route('dashboard.user.update', ['fa', $user]), [
            'name' => '',
            'email' => 'hamedghaderii@gmail.com',
            'phone' => '09369396387'
        ])->assertSessionHasErrors('name');
    }
}
