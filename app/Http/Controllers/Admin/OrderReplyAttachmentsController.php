<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderReply;
use Illuminate\Http\Request;

class OrderReplyAttachmentsController extends Controller
{
    /**
     * Get attachment for an order reply.
     *
     * @param $locale
     * @param  OrderReply  $reply
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($locale, OrderReply $reply)
    {
        return response()->download(
            storage_path() . '/app/' . $reply->path
        );
    }
}
