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

    /** @test **/
    public function a_service_requires_a_name()
    {
        $user = $this->signIn();

        $service = factory(Service::class)->raw(['name' => null]);

        $this->post('/dashboard/' . $user->name . '/services', $service)
            ->assertSessionHasErrors('name');
    }

    /** @test  **/
    public function a_user_can_update_a_service()
    {
       $user = $this->signIn() ;

       $service = factory(Service::class)->create();

       $this->patch('/dashboard/' . $user->name . '/services/' .  $service->id, ['name' => 'Changed']);

       $this->assertDatabaseHas('services', ['name' => 'Changed']);
    }

    /** @test **/
    public function a_user_can_delete_a_service()
    {
        $user = $this->signIn() ;

        $service = factory(Service::class)->create(['name' => 'My Service']);

        $this->assertDatabaseHas('services', ['name' => 'My Service']);

        $this->delete('/dashboard/' . $user->name . '/services/' .  $service->id);

        $this->assertDatabaseMissing('services', ['name' => 'My Service']);
    }
}
