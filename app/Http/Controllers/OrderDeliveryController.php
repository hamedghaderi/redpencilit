<?php

namespace App\Http\Controllers;

use App\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Zttp\Zttp;

class OrderDeliveryController extends Controller
{
    
    /**
     * Guzzle HTTP Client
     *
     * @var Client
     */
    protected $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function store($locale, Order $order)
    {
        if ( ! auth()->user()->is($order->owner)) {
            abort(403);
        }
        
        $response = Zttp::post('https://pay.ir/pg/send', [
            'api' => "test",
            'amount' => $order->price * 10,
            'redirect' => route('orders.confirm', [app()->getLocale(), $order->id])
        ]);
        
        return $response;
    }
    
    public function confirm($locale, Order $order)
    {
        if ((int) request('status') === 1) {
            $response = Zttp::post('https://pay.ir/pg/verify', [
                'api' => 'test',
                'token' => request('token')
            ]);
            
           dd($response->json());
         }
    }
}
