<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketsController extends Controller
{
    
    /**
     * Get paginated tickets for a user
     *
     * @return mixed
     */
    public function create()
    {
        $tickets = auth()->user()->tickets()->with('replies')->paginate(5);
        
        return view('tickets.create', compact('tickets'));
    }
    
    /**
     * Show a single ticket.
     *
     * @param $locale
     * @param  Ticket  $ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, Ticket $ticket)
    {
        if (! auth()->user()->is($ticket->owner)) {
            abort(403);
        }
        
       return view('admin.tickets.show', ['ticket' => $ticket->load('owner', 'replies.owner')]);
    }
    
    /**
     * Store a new ticket for a user
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'bail|required|min:3|max:255|string',
            'body' => 'bail|required|string|min:5',
            'attachment' => 'sometimes|nullable|file|mimes:png,jpeg,gif,pdf|max:1024'
        ]);
        
        if (request()->hasFile('attachment')) {
            $path = request()->file('attachment')->store('/', 'ticket');
            $attributes['attachment'] = $path;
        }
        
        $ticket = auth()->user()->tickets()->create($attributes);
        
        if (request()->expectsJson()) {
            return response()->json($ticket->load('replies'));
        }
        
        return redirect(route('tickets.create', app()->getLocale()));
    }
}
