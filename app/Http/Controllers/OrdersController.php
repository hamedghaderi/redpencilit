<?php

namespace App\Http\Controllers;

use App\DocumentWordCount;
use App\Order;
use App\Rules\MaxWord;
use App\Service;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $orders = $user->orders->each(function ($order) {
          $order->load('details');
        });
        
        return view('orders.index', compact('orders'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'orders.create', [
            'services' => Service::latest()->get()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function store(User $user)
    {
        if (auth()->user()->isNot($user)) {
            return abort(403);
        }
        
        $setting = Setting::first();
        
        try {
            \request()->validate(
                [
                    'documents' => ['required', 'array', new MaxWord, 'max:'.$setting->upload_articles_per_day],
                    'documents.*' => 'required|file|mimes:docx|distinct'
                ]);
        } catch (ValidationException $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }
        
        $documents = $this->appendFileWordCountsPerDocument();
        
        $delivery_date = $this->estimateDeliveryDate($documents->sum('words'), $setting);
        
        $order = auth()->user()->orders()->create(
            [
                'total_words' => $documents->sum('words'),
                'status' => config('orders-status.in-progress'),
                'delivery_date' => $delivery_date,
                'orders_count' => count(request()->documents),
                'price' => $this->calculatePrice($documents, $setting)
            ]);
        
        foreach (request()->documents as $document) {
            $path = $document->store(auth()->user()->username, 'documents');
            
            $order->details()->create(
                [
                    'name' => $document->getClientOriginalName(),
                    'path' => $path,
                    'words' => DocumentWordCount::file($document)->countWords(),
                ]);
        }
        
        return response()->json(
            [
                'status' => 200,
                'data' => $order->load('details')
            ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  User   $user
     * @param  Order  $order
     *
     * @return void
     */
    public function destroy(User $user, Order $order)
    {
        if (auth()->user()->isNot($user)) {
            abort(4003);
        }
        
        $order->details->each(
            function ($document) {
                Storage::disk('documents')->delete($document->path);
            });
        
        $order->delete();
        $order->details()->delete();
        
        return response()->json([
            'status' => 200,
        ]);
    }
    
    /**
     * Estimate how much it takes to deliver translation of an uploaded article.
     *
     * @param $words
     * @param $setting
     *
     * @return Carbon
     */
    protected function estimateDeliveryDate($words, $setting)
    {
        $ordersList = Order::orderBy('delivery_date', 'DESC')
                           ->where('status', config('orders-status.payed'))
                           ->first();
        
        $order = Order::where('status', config('orders-status.payed'))
                      ->whereRaw('total_words + '.$words.' < '.$setting->upload_words_per_day)
                      ->whereDate(
                          'delivery_date', '>=',
                          Carbon::createFromTime('12', '0', '0')->addWeek()
                      )->whereRaw(
                'orders_count + '.count(\request()->documents).' <= '.$setting->upload_articles_per_day
            )->first();
        
        if ($order && $order->count()) {
            return $order->created_at;
        }
        
        if ($ordersList) {
            return $ordersList->delivery_date->addDay();
        }
        
        return Carbon::createFromTime('12', '0', '0')->addWeek();
    }
    
    /**
     * Calculate price of uploaded documents
     *
     * @param $documents
     * @param $setting
     *
     * @return float|int
     */
    protected function calculatePrice($documents, $setting)
    {
        $price = 0;
        
        foreach ($documents as $document) {
            if ($document['words'] * $setting->price_per_word < $setting->base_price_for_docs) {
                $price += $setting->base_price_for_docs;
            } else {
                $price += $document['words'] * $setting->price_per_word;
            }
        }
        
        return $price;
    }
    
    /**
     * Calculate each file words count.
     *
     * @return array
     */
    protected function appendFileWordCountsPerDocument()
    {
        $documents = [];
        
        foreach (request()->documents as $key => $document) {
            $documents[$key]['document'] = $document;
            $documents[$key]['words'] = DocumentWordCount::file($document)->countWords();
        }
        
        return collect($documents);
    }
}
