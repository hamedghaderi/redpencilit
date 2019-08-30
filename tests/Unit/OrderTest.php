<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use App\Service;
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
    
    /** @test **/
    public function it_belongs_to_a_service()
    {
        $this->withoutExceptionHandling();
        
        $service = create(Service::class);
        $order = create(Order::class, ['service_id' => $service->id]);
       
       $this->assertEquals($service->fresh(), $order->service);
    }
}
