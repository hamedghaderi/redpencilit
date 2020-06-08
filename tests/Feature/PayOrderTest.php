<?php

namespace Tests\Feature;

use App\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayOrderTest extends TestCase
{

    use RefreshDatabase;

    /** @test * */
    public function a_completed_order_can_get_paid()
    {
        $this->withoutExceptionHandling();

        $order = create(Order::class);

        $response = $this->be($order->owner)->post(
            route(
                'orders.store',
                [app()->getLocale(), $order->id])
        )->assertSee('token')
                         ->assertJson(['status' => 1]);

        $response = json_decode($response->getContent(), true);

        $this->assertDatabaseHas('orders', [
            'id' => $order->fresh()->id,
            'token' => $response['token']
        ]);
    }

    /** @test * */
    public function guests_can_not_pay_orders()
    {
        $order = create(Order::class);

        $this->post(
            route('orders.store', [app()->getLocale(), $order->id])
        )->assertRedirect(route('login', app()->getLocale()));
    }

    /** @test * */
    public function authenticated_users_can_not_pay_orders_of_other_users()
    {
        $order = create(Order::class);

        $this->signIn();

        $this->post(
            route('orders.store', [app()->getLocale(), $order->id])
        )->assertStatus(403);
    }

    /** @test * */
    public function a_wrong_order_will_can_not_paid()
    {
        $this->withoutExceptionHandling();

        $order = create(Order::class);

        $order = create(Order::class);

        $this->expectException(ModelNotFoundException::class);

        $response = $this->be($order->owner)->post(
            route(
                'orders.store',
                [app()->getLocale(), 4])
        );
    }
}
