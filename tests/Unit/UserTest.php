<?php

namespace Tests\Unit;

use App\Order;
use App\Role;
use App\Setting;
use App\User;
use App\UserDetail;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /** @test * */
    public function it_has_many_settings()
    {
        $user = $this->signIn();

        factory(Setting::class)->create(['owner_id' => $user->id]);

        $this->assertInstanceOf(Setting::class, $user->setting);
    }
    
    /** @test **/
    public function it_may_have_many_orders()
    {
       $user = create(User::class);
       $order = create(Order::class, ['owner_id' => $user->id]);
       
       $this->assertInstanceOf(Collection::class, $user->orders);
    }

    /** @test * */
    public function a_user_may_set_many_services()
    {
        $user = $this->signIn();

        $this->assertInstanceOf(Collection::class, $user->services);
    }
    
    /** @test **/
    public function it_can_add_role()
    {
       $user = create(User::class);
       
       $role = create(Role::class);
       
       $user->addRole($role);
       
       $this->assertCount(1, $user->roles);
    }
    
    /** @test **/
    public function it_can_check_his_role()
    {
       $user = create(User::class) ;
       $role = create(Role::class);
       
       $user->addRole($role);
       
       $this->assertTrue($user->hasRole($role));
    }
    
    /** @test **/
    public function it_can_be_an_admin()
    {
       $user = create(User::class);
       $role = create(Role::class, ['name' => 'super-admin']);
       
       $user->addRole($role);
       
       $this->assertTrue($user->isSuperAdmin());
    }
    
    /** @test **/
    public function it_can_have_posts()
    {
        $this->withoutExceptionHandling();
       $user = create(User::class);
       
       $this->assertInstanceOf(Collection::class, $user->posts);
    }
    
    /** @test **/
    public function it_can_have_details()
    {
       $this->withoutExceptionHandling() ;
       
       $user = create(User::class);
       $details = create(UserDetail::class, ['user_id' => $user->id]);
       
       $this->assertInstanceOf(UserDetail::class, $user->details);
    }
}
