<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderSettleController extends Controller
{
    
    /**
     * Show an order.
     *
     * @param $locale
     * @param  Order  $order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, Order $order)
    {
        session()->flash('flash', 'Payment has done successfully.');
        
        return view('orders.receipt')
            ->with('order', $order->with('owner'));
    }
}
