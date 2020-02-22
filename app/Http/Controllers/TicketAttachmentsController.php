<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class TicketAttachmentsController extends Controller
{
    
    /**
     * Return a ticket document.
     *
     * @param $locale
     * @param  Ticket  $ticket
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($locale, Ticket $ticket)
    {
        if (! auth()->user()->is($ticket->owner)) {
            abort(403);
        }
        
        $path = storage_path('app/tickets/') . $ticket->attachment;  // storage/app
        
        if (file_exists($path)) {
            return Response::download($path);
        }
        
        abort(403);
    }
}
