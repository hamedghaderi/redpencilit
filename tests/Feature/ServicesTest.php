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
        
        $service = [
            'fa-name' => 'Farsi Book',
            'en-name' => 'Book'
        ];
        
        $this->post(route('services.store', app()->getLocale()), $service)
             ->assertRedirect(route('services.index', app()->getLocale()));
        
        $this->assertCount(1, Service::where('name->fa', 'Farsi Book')->get());
        $this->assertCount(1, Service::where('name->en', 'Book')->get());
        
        $this->assertCount(1, $user->services);
    }
    
    /** @test * */
    public function a_service_requires_a_valid_name()
    {
        $user = $this->signIn();
        
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = [
            'fa-name' => null,
            'en-name' => null
        ];
        
        $this->post(
            route('services.index', app()->getLocale()),
            $service
        )->assertSessionHasErrors('fa-name')
             ->assertSessionHasErrors('en-name');
    }
    
    /** @test * */
    public function guests_cannot_make_a_service()
    {
        $service = make(Service::class);
        
        $this->post(route('services.store', [app()->getLocale(), 1]), $service->toArray())
             ->assertRedirect(route('login', app()->getLocale()));
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
        
        $this->delete(route('services.delete', [app()->getLocale(), $service]))
             ->assertRedirect(route('services.index', app()->getLocale()));
        
        $this->assertCount(0, Service::where(['name->fa', $service->name['fa']])->get());
        $this->assertCount(0, Service::where(['en->fa', $service->name['en']])->get());
        $this->assertCount(1, Service::onlyTrashed()->get());
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
                ['locale' => app()->getLocale(), 'user' => $user->id, 'service' => $service->id]))
             ->assertStatus(403);
    }
    
    /** @test * */
    public function an_admin_can_update_a_service()
    {
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
        
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->patch(route('services.update', [app()->getLocale(), $service]), [
            'fa-name' => 'Persian Business Card',
            'en-name' => 'English Business Card'
        ])->assertRedirect(route('services.index', app()->getLocale()));
        
        $this->assertCount(
            1,
            Service::where('name->fa', 'Persian Business Card')
                   ->where('id', $service->id)
                   ->get()
        );
        $this->assertCount(
            1,
            Service::where('name->en', 'English Business Card')
                   ->where('id', $service->id)
                   ->get()
        );
    }
    
    /** @test * */
    public function updating_a_service_requires_a_valid_name()
    {
        $user = $this->signIn();
        $role = create(Role::class, ['name' => 'super-admin']);
        $user->addRole($role);
        
        $service = create(Service::class, ['user_id' => $user->id]);
        
        $this->patch(
            route(
                'services.update', [
                'locale' => app()->getLocale(),
                'user' => $user->id,
                'service' => $service->id
            ]),
            ['fa-name' => null, 'en-name' => null]
        )->assertSessionHasErrors('fa-name')
            ->assertSessionHasErrors('en-name');
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
                'locale' => app()->getLocale(),
                'user' => $user->id,
                'service' => $service->id
            ]),
            ['fa-name' => 'Blabla', 'en-name' => 'blabla']
        )->assertStatus(403);
    }
    
    /** @test * */
    public function users_can_see_all_services()
    {
        $this->signIn();
        $service = create(Service::class);
        
        $this->get(route('new-order', app()->getLocale()))
             ->assertSee($service->name['fa'])
            ->assertSee($service->name['en']);
    }
}
