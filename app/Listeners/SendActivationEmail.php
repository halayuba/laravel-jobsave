<?php

namespace App\Listeners;

use App\Events\ActivationEmailRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Mail\ActivationTokenEmail;

class SendActivationEmail
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
     * @param  ActivationEmailRequested  $event
     * @return void
     */
    public function handle(ActivationEmailRequested $event)
    {
        if($event->user->is_active) return;

       //== SEND EMAIL FOR ACCOUNT VERIFICATION
     //====================
      \Mail::to($event->user->email)->send(new ActivationTokenEmail($event->user));

    }
}
