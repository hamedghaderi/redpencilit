<?php

namespace Tests\Feature;

use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageServices extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function an_authenticated_user_can_create_a_service()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $service = factory(Service::class)->raw();

        $this->post('/dashboard/' . $user->name . '/services', $service)
            ->assertRedirect('/dashboard/' . $user->name . '/services');

        $this->assertDatabaseHas('services', ['name' => $service['name']]);
    }

    /** @test **/
    public function guests_cannot_create_a_service()
    {
       $service = factory(Service::class)->raw();

       $this->post('/dashboard/1/services', $service)->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_view_all_services()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

       $services = factory(Service::class)->create();

       $this->get('/dashboard/' . $user->name . '/services')->assertSee($services->name);
    }
}
