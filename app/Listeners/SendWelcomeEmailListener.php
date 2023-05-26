<?php

namespace App\Listeners;

use App\Events\WelcomeEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmailListener
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeEmailEvent $event)
    {
        $user = $event->user;
        Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
    }
}
