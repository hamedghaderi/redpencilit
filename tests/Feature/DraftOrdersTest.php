<?php

namespace Tests\Feature;

use App\Order;
use App\OrderDetail;
use App\Service;
use App\Setting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DraftOrdersTest extends TestCase
{
    
    use RefreshDatabase;
    
    /** @test * */
    public function users_can_select_from_setting_and_make_a_draft_from_their_uploads()
    {
        $this->withoutExceptionHandling();
        
        $setting = create(Setting::class);
        $service = create(Service::class);
        
        $user = $this->signIn();
        $user->confirmed = true;
        
        $order = create(Order::class);
        create(OrderDetail::class, ['order_id' => $order->id]);
        
        $this->json(
            'post', route('drafts.store', [app()->getLocale(), $user]), [
            'service_id' => $service->id,
            'order_id' => $order->id
        ]);
        
        $this->assertDatabaseHas('orders', ['service_id' => $service->id]);
    }
}
