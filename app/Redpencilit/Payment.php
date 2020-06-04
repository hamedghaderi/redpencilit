<?php

namespace App\Redpencilit;

use App\Order;
use Zttp\Zttp;

class Payment
{
    
    /**
     * The amount of order
     *
     * @var Int
     */
    protected $amount;
    
    /**
     * An order to apy
     *
     * @var Order
     */
    protected $order;
    
    /**
     * Get the current order.
     *
     * @param  Order  $order
     *
     * @return $this
     */
    public function order(Order $order)
    {
        $this->order = $order;
        
        return $this;
    }
    
    /**
     * Get the amount of order
     *
     * @param $amount
     *
     * @return $this
     */
    public function amount($amount)
    {
        $this->amount = $amount * 10;
        
        return $this;
    }
    
    /**
     * Send the payment data to the third party service.
     *
     * @return mixed
     */
    public function send()
    {
        $response = Zttp::post('https://pay.ir/pg/send', [
            'api' => config('services.payir.key'),
            'amount' => $this->amount,
            'redirect' => route('orders.confirm'),
            'factorNumber' => $this->order->id,
        ]);
        
        if ($response->json()['status'] == 0) {
            abort(500);
        }
        
        return $response->json();
    }
    
    /**
     * Verify the order.
     *
     * @param $token
     *
     * @return mixed
     */
    public function verify($token)
    {
        $response = Zttp::post('https://pay.ir/pg/verify', [
            'api' => config('services.payir.key'),
            'token' => $token
        ]);
        
        
        if ($response->json()['status'] === 0) {
            abort(500, __('Server Error. Verification failed'));
        }
        
        return $response->json();
    }
}
