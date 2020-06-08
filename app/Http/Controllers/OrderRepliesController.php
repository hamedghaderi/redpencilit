<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderReply;
use App\Reply;
use Illuminate\Http\Request;

class OrderRepliesController extends Controller
{
    public function show($locale, OrderReply $reply)
    {
        if (! auth()->user()->is($reply->order->owner)) {
            abort(403);
        }

        $data = storage_path('app/').$reply->path;

        if (is_file($data)) {
            return response()->download($data);
        }

        return back();
    }
}
