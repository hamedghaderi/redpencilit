<?php

namespace App\Http\Controllers\Admin;

use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{

    /**
     * Get all orders of all users.
     *
     * @param $locale
     *
     * @param  OrderFilter  $filter
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($locale, OrderFilter $filter)
    {
        $orders = Order::with('owner', 'details')
            ->filter($filter)
            ->paginate(25);

        return view('admin.orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show a specific order
     *
     * @param $locale
     * @param  Order  $order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, Order $order)
    {
        return view('admin.orders.show')->with('order', $order->load('owner', 'details'));
    }
}
