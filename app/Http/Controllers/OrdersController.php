<?php

namespace App\Http\Controllers;

use App\DocumentWordCount;
use App\Order;
use Facades\App\Redpencilit\DocumentService;
use App\Rules\MaxWord;
use App\Service;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index($locale, User $user)
    {
        $user = auth()->user()->load([
            'orders' => function ($order) {
                $order->filterBy(request('type'))->with('details');
            }
        ]);

        return view('orders.index', compact('user'));
    }

    /**
     * Show an order with its replies to user.
     *
     * @param $locale
     * @param  User  $user
     * @param  Order  $order
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, User $user, Order $order)
    {
       if (!$order->owner->is(auth()->user()))  {
           abort(403);
       }

       return view('orders.show', ['order' => $order->load('replies')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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
     * @param        $locale
     * @param  User  $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|void
     */
    public function store($locale, User $user)
    {
        $setting = Setting::first();

        try {
            request()->validate([
                'documents' => [
                    'required',
                    'array',
                    new MaxWord,
                    'max:'.$setting->upload_articles_per_day
                ],
                'documents.*' => 'required|file|mimes:docx|distinct'
            ]);
        } catch (ValidationException $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }

        $documents = $this->appendFileWordCountsPerDocument();

        $delivery_date = $this->estimateDeliveryDate($documents->sum('words'), $setting);

        $order = auth()->user()->orders()->create([
            'total_words' => $documents->sum('words'),
            'status' => config('orders-status.unfulfilled'),
            'delivery_date' => $delivery_date,
            'orders_count' => count(request()->documents),
            'price' => $this->calculatePrice($documents, $setting),
        ]);

        foreach (request()->documents as $document) {
            $path = $document->store(auth()->user()->id, 'documents');

            $order->details()->create([
                'name' => $document->getClientOriginalName(),
                'path' => $path,
                'words' => DocumentWordCount::file($document)->countWords(),
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $order->load('details')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param         $locale
     * @param  User  $user
     * @param  Order  $order
     *
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Exception
     */
    public function destroy($locale, User $user, Order $order)
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
     * @return array|\Illuminate\Support\Collection|\Tightenco\Collect\Support\Collection
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
