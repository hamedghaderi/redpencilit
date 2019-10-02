<?php

namespace Tests\Feature;

use App\Role;
use App\Service;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicesTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function admin_can_make_a_new_service()
    {
        $this->withoutExceptionHandling();
        
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = make(Service::class);
        
        $this->post(route('services'), $service->toArray())
             ->assertRedirect(route('services'));
        
        $this->assertDatabaseHas('services', ['name' => $service->name]);
        
        $this->assertCount(1, $user->services);
    }
    
    /** @test * */
    public function a_service_requires_a_valid_name()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = make(Service::class, ['name' => null]);
        
        $this->post(
            route('services', $user),
            $service->toArray())->assertSessionHasErrors('name');
    }
    
    /** @test * */
    public function guests_cannot_make_a_service()
    {
        $service = make(Service::class);
        
        $this->post(route('services.store', 1), $service->toArray())
             ->assertRedirect('/login');
    }
    
    /** @test * */
    public function authenticated_user_if_is_not_admin_cannot_make_service()
    {
        $user = $this->signIn();
        
        $service = make(Service::class);
        
        $this->post(route('services.store', $user), $service->toArray())
             ->assertStatus(403);
    }
    
    /** @test * */
    public function except_admin_no_one_can_make_service()
    {
        $user = $this->signIn();
        
        $role = make(Role::class, ['name' => 'creator', 'slug' => 'creator']);
        
        $service = make(Service::class);
        
        $this->post(route('services.store', $user), $service->toArray())
             ->assertStatus(403);
    }
    
    /** @test * */
    public function an_admin_user_can_delete_a_service()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->delete(route('services.delete', ['service' => $service->id]))
             ->assertRedirect(route('services'));
        
        $this->assertSoftDeleted('services', ['name' => $service->name]);
    }
    
    /** @test * */
    public function except_admin_no_one_can_delete_a_service()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'creator']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->delete(
            route(
                'services.delete',
                ['user' => $user->id, 'service' => $service->id]))
             ->assertStatus(403);
    }
    
    /** @test * */
    public function an_admin_can_update_a_service()
    {
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        
        $this->patch(route('services.update', ['service' => $service->id]), [
            'name' => 'Blabla'
        ])->assertRedirect(route('services'));
        
        $this->assertDatabaseHas('services', ['name' => 'Blabla']);
    }
    
    /** @test * */
    public function updating_a_serivce_requires_a_valid_name()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->patch(
            route(
                'services.update', [
                'user' => $user->id,
                'service' => $service->id
            ]),
            ['name' => null]
        )->assertSessionHasErrors('name');
    }
    
    /** @test * */
    public function only_admin_can_update_a_service()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'creator']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->patch(
            route(
                'services.update', [
                'user' => $user->id,
                'service' => $service->id
            ]),
            ['name' => 'Blabla']
        )->assertStatus(403);
    }
    
    /** @test * */
    public function users_can_see_all_services()
    {
        $this->signIn();
        $service = create(Service::class);
        
        $this->get(route('new-order'))->assertSee($service->name);
    }
}
