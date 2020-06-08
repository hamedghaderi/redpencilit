<?php

namespace App\Http\Controllers;

use App\Notifications\NewOrderPaid;
use App\Notifications\OrderRegistered;
use App\Order;
use App\Redpencilit\Payment;
use App\User;

class OrderDeliveryController extends Controller
{

    /**
     * Add a new Payment.
     *
     * @var Payment
     */
    private $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Request for a new payment.
     *
     * @param $locale
     * @param  Order  $order
     *
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($locale, Order $order)
    {
        $this->authorize('update', $order);

        $response = $this->payment->order($order)
            ->amount($order->price)
            ->send();

        if (array_key_exists('token', $response)) {
            $order->addToken($response['token']);

            if (app()->environment() === 'testing') {
                return $response;
            }

            return redirect(env('PAYIR_URL').$response['token']);
        }

        return false;
    }

    /**
     * Confirm and verify the order.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function confirm()
    {
        if ((int) request('status') === 0) {
            return $this->orderFailed();
        }

        $response = $this->payment->verify(request('token'));

        $order = Order::settled($response, request('token'));

        User::admin()->first()->notify(new NewOrderPaid($order, app()->getLocale()));
        auth()->user()->notify(new OrderRegistered($order, app()->getLocale()));

        return redirect(
            route(
                'orders.settled.show',
                [app()->getLocale(), $order]
            )
        );
    }

    /**
     * Return a failed message and redirect user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function orderFailed()
    {
        return redirect(
            route(
                'users.orders.index',
                [app()->getLocale(), auth()->id()]
            ))->with(
            'flash',
            "Unfortunately, order compilation failed. Please try to pay again to accomplishing order."
        )->with('status', 'danger');
    }
}
