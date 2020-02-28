<?php

namespace App\Http\Controllers;

use App\Order;
use App\Redpencilit\Payment;

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($locale, Order $order)
    {
        if ( ! auth()->user()->is($order->owner)) {
            abort(403);
        }
        
        $response = $this->payment->order($order)
            ->amount($order->price)
            ->send();
        
        if (app()->environment() === 'testing') {
            return $response;
        }
        
        return redirect(env('PAYIR_URL') . $response['token']);
    }
    
    /**
     * Confirm and verify the order.
     *
     * @param $locale
     * @param  Order  $order
     */
    public function confirm($locale, Order $order)
    {
        if ((int) request('status') === 1) {
            $response = $this->payment->verify(require('token'));
            
            dd($response);
         }
    }
}
