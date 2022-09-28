<?php

namespace App\Listeners;

use App\Events\verifyOrder;
use App\Mail\orderVerficationMail;
use Illuminate\Support\Facades\Mail;


class acceptOrder
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
     * @param  \App\Events\verifyOrder  $event
     * @return void
     */
    public function handle(verifyOrder $event)
    {
        $user_email = auth()->user()->email;
        Mail::to($user_email)->send(new orderVerficationMail($event->data));
    }
}
