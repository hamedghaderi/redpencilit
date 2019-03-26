<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageDashboard extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function authenticated_users_can_visit_their_dashboard()
    {
        $this->withoutExceptionHandling();

       $user = $this->signIn();

       $this->get('/dashboard')->assertSee($user->name);
    }
}
