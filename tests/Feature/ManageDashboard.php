<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageDashboard extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function authenticated_users_can_visit_their_dashboard()
    {
       $user = $this->signIn();

       $this->get('/dashboard/' . $user->name)->assertSee($user->name);
    }

    public function authenticated_users_cannot_visit_others_dashboard()
    {
        $this->signIn();

        $otherUser = factory(User::class)->create();

        $this->get('/dashboard/' . $otherUser->name)->assertStatus(403);
    }

    public function guests_cannot_visit_dashboard()
    {
       $this->get('/dashboard/1')->assertRedirect('login');
    }
}
