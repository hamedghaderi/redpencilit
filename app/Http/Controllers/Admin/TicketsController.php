<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    
    /**
     * Show a single ticket to admin.
     *
     * @param $locale
     * @param  Ticket  $ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($locale, Ticket $ticket)
    {
        $ticket = $ticket->load('owner', 'replies.owner');
        
        
        return view('admin.tickets.show', compact('ticket'));
    }
}
