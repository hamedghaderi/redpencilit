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

        $this->signIn();

        $service = factory(Service::class)->raw();

        $this->post('/dashboard/services', $service)->assertRedirect('/dashboard/services');

        $this->assertDatabaseHas('services', ['name' => $service['name']]);
    }

    /** @test **/
    public function guests_cannot_create_a_service()
    {
       $service = factory(Service::class)->raw();

       $this->post('/services', $service)->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_view_all_services()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

       $services = factory(Service::class)->create();

       $this->get('/dashboard/services')->assertSee($services->name);
    }
}
