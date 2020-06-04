<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderAttachmentsController extends Controller
{
    
    /**
     * Get an attachment of a given order
     *
     * @param $locale
     * @param  Order  $order
     * @param  OrderDetail  $detail
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($locale, Order $order, OrderDetail $detail)
    {
       $this->authorize('update', $order);
        
        $path = storage_path("app/").$detail->path;  // storage/app
        
        if (file_exists($path)) {
            return Response::download($path);
        }
        
        abort(403);
    }
}
