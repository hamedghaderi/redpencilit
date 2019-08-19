<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Document;
use App\DocumentDraft;
use App\DraftReserve;
use App\Order;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
    
    public function store(User $user)
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
