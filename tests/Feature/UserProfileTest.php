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
          factory(User::class)->create(['name' => 'Jane', 'email' => 'jane@doe.com', 'phone' => '09369396387'])
      );

       $attributes = [
           'name' => 'John',
           'email' => 'john@doe.com',
           'phone' => '09360000000'
       ];

       $this->patch('/dashboard/' . $user->id, $attributes);

      $this->assertDatabaseHas('users', $attributes);
   }

   /** @test **/
   public function guests_cannot_update_user_information()
   {
       $this->patch('/dashboard/1', [])->assertRedirect('login');
   }

   /** @test **/
    public function update_user_account_requires_valid_phone_number()
    {
        $user = $this->signIn(
            factory(User::class)->create([
                'name' => 'Jane',
                'email' => 'jane@doe.com',
                'phone' => '09369396387'
            ])
        );

        $attributes = ['phone' => null];

        $this->patch('/dashboard/' . $user->id, $attributes)
            ->assertSessionHasErrors('phone');

        $attributes = ['phone' => '9023920342039'];

        $this->patch('/dashboard/' . $user->id, $attributes)
            ->assertSessionHasErrors('phone');
    }

    /** @test **/
    public function update_user_account_requires_valid_email_address()
    {
        $this->withoutExceptionHandling();
        
        $user = $this->signIn(
            factory(User::class)->create([
                'name' => 'Jane',
                'email' => 'jane@doe.com',
                'phone' => '09369396387'
            ])
        );

        $this->patch(route('dashboard.user.update', [$user, 'en']), ['email' => null])
            ->assertSessionHasErrors('email');
        
        $this->patch(route('dashboard.user.update', [$user, 'en']), ['email' => 'johasdfasdf'])
            ->assertSessionHasErrors('email');
    }

    /** @test **/
    public function update_user_account_requires_valid_name()
    {
        $user = $this->signIn(
            factory(User::class)->create([
                'name' => 'Jane',
                'email' => 'jane@doe.com',
                'phone' => '09369396387'
            ])
        );

        $attributes = [
            'name' => null
        ];

        $this->patch('/dashboard/' . $user->id, $attributes)
            ->assertSessionHasErrors('name');


        $attributes = [
            'email' => 'ab'
        ];

        $this->patch('/dashboard/' . $user->username, $attributes)
            ->assertSessionHasErrors('name');
    }
}
