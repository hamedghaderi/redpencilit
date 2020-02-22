<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    
    /**
     * Create a new reply for the given ticket.
     *
     * @param $locale
     * @param  Ticket  $ticket
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store($locale, Ticket $ticket)
    {
        request()->validate([
            'body' => ['required', 'string', 'min:5']
        ]);
        
        $admin = User::admin()->first();
        
        if (!(
            auth()->user()->is($ticket->owner)
         || auth()->user()->is($admin)
        )) {
            abort(403);
        }
        
        $reply = $ticket->replies()->create([
            'body' => request('body'),
            'owner_id' => auth()->id()
        ]);
        
        if (\request()->wantsJson()) {
            return response()->json($reply);
        }
        
        return back();
    }
    
    /**
     * Delete the given reply
     *
     * @param $locale
     * @param  Reply  $reply
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($locale, Reply $reply)
    {
        if ( ! auth()->user()->is($reply->owner)) {
            abort(403);
        }
        
        $reply->delete();
        
        if (\request()->expectsJson()) {
            return response()->json([
                'success' => true
            ]);
        }
        
        return back();
    }
}
