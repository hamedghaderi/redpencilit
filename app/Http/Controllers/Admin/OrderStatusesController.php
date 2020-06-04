<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\StatusChanged;
use App\Order;
use Illuminate\Http\Request;

class OrderStatusesController extends Controller
{
    
    /**
     * Update status of an order.
     *
     * @param $locale
     * @param  Order  $order
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($locale, $orderId)
    {
       request()->validate([
           'status' => 'required|numeric|in:1,2,3'
       ]);
       
       $order = Order::findOrFail($orderId);
       
       $order->changeStatus(request('status'));
       
       $order->owner->notify(new StatusChanged($order));
       
       return response()->json([
           'data' => [
               'message' => 'updated successfully',
               'status' => 200
           ]
       ]);
    }
}
