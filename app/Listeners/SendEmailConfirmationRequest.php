<?php

namespace App\Listeners;

use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SendEmailConfirmationRequest
{
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     *
     * @return void
     */
    public function handle(Registered $event)
    {
        try {
            Mail::to($event->user)
                ->send(new PleaseConfirmYourEmail ($event->user));
        } catch (\Error $e) {
            DB::rollBack();
    
            throw new ProcessFailedException;
        }
        
        DB::commit();
    }
}
