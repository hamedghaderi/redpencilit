<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\OrderReplyCompleted;
use App\Order;
use Illuminate\Http\Request;

class UploadOrderReplyController extends Controller
{
    public function create($locale, Order $order)
    {
        return view('admin.orders.upload', ['order' => $order->load('replies')]);
    }

    public function store($locale, Order $order)
    {
        request()->validate([
            'attachments' => 'array',
            'attachments.*' => 'sometimes|file|mimes:pdf,docx',
            'mail-body' => 'sometimes|nullable|string',
        ]);

        foreach (request()->file('attachments') as $attachment) {
            $path = $attachment->storeAs(
                '/users/'.$order->owner_id.'/replies',
                $attachment->hashName(),
                'local'
            );

            $order->replies()->create([
                'path' => $path,
                'original_name' => $attachment->getClientOriginalName(),
                'message' => request('mail-body'),
            ]);
        }

        $order->owner->notify(new OrderReplyCompleted($order));

        return back()->with(
            'flash',
            __('Files has been uploaded successfully.')
        );
    }
}
