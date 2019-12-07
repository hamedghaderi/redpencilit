<?php

namespace App\Http\Controllers;

use App\DocumentDraft;
use App\Order;
use App\User;

class DraftsController extends Controller
{
    
    //    public function index(User $user)
    //    {
    //       if (auth()->user()->isNot($user))  {
    //           abort(403);
    //       }
    //
    //       $documents = DocumentDraft::with('service')->get();
    //
    //       return view('dashboards.drafts', compact('documents'));
    //    }
    
    public function store($locale, User $user)
    {
        if (auth()->user()->isNot($user)) {
            abort(403);
        }
        
        request()->validate(
            [
                'service_id' => 'required|numeric|exists:services,id',
                'order_id' => 'required|numeric|exists:orders,id'
            ]);
        
        $order = Order::where('id', \request('order_id'))->first();
        
        $order->update([
            'service_id' => \request('service_id')
        ]);
        
        return response()->json([
            'status' => 200,
            'data' => $order->fresh()->load('details')
        ]);
    }
}
