<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test **/
    public function it_has_many_details()
    {
       $order = create(Order::class);
       
       $details = create(OrderDetail::class, ['order_id' => $order->id]);
       
       $this->assertInstanceOf(Collection::class, $order->details);
    }
}
