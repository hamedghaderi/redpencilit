<?php

namespace Tests\Feature;

use App\Role;
use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageServices extends TestCase
{

    use RefreshDatabase;

    private $role;

    protected function setUp()
    {
        parent::setUp();

        $this->role = create(Role::class)->create(['name' => 'Admin']);
    }

    /** @test * */
    public function admin_user_can_create_a_service()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $user->roles()->attach($this->role->id);

        $service = factory(Service::class)->raw(['negotiable' => true]);

        $this->post('/dashboard/'.$user->username.'/services', $service)
            ->assertRedirect('/dashboard/'.$user->username.'/services');

        $this->assertDatabaseHas('services', ['name' => $service['name']]);
        $this->assertDatabaseHas('services', ['negotiable' => true]);
    }

    /** @test * */
    public function authenticated_users_cannot_add_settings()
    {
        $user = $this->signIn();

        $service = make(Service::class, ['negotiable' => true]);

        $this->post('/dashboard/'.$user->username.'/services',
            $service->toArray())
            ->assertStatus(403);

        $this->assertDatabaseMissing('services', ['name' => $service['name']]);
        $this->assertDatabaseMissing('services', ['negotiable' => true]);
    }

    /** @test * */
    public function guests_cannot_create_a_service()
    {
        $service = factory(Service::class)->raw();

        $this->post('/dashboard/1/services', $service)->assertRedirect('login');
    }

    /** @test * */
    public function a_user_can_view_all_services()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $user->roles()->attach($this->role->id);

        $service = factory(Service::class)->create();

        $response = $this->json('get',
            '/dashboard/'.$user->username.'/services');

        $response->assertJson([['name' => $service->name]]);
    }

    /** @test * */
    public function a_service_requires_a_name()
    {
        $user = $this->signIn();

        $user->roles()->attach($this->role->id);

        $service = factory(Service::class)->raw(['name' => null]);

        $this->post('/dashboard/'.$user->username.'/services', $service)
            ->assertSessionHasErrors('name');
    }

    /** @test  * */
    public function admin_can_update_a_service()
    {
        $user = $this->signIn();

        $user->roles()->attach($this->role->id);

        $service = factory(Service::class)->create(['negotiable' => false]);

        $this->patch('/dashboard/'.$user->username.'/services/'.$service->id, [
            'name' => 'Changed',
            'negotiable' => true
        ]);

        $this->assertDatabaseHas('services',
            ['name' => 'Changed', 'negotiable' => true]);
    }

    /** @test * */
    public function admin_can_delete_a_service()
    {
        $user = $this->signIn();

        $user->roles()->attach($this->role->id);

        $service = factory(Service::class)->create(['name' => 'My Service']);

        $this->assertDatabaseHas('services', ['name' => 'My Service']);

        $this->delete('/dashboard/'.$user->username.'/services/'.$service->id);

        $this->assertDatabaseMissing('services', ['name' => 'My Service']);
    }
}
