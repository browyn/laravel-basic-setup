<?php

namespace App\Listeners\Auth;

use App\Events\Auth\EmailVerified;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailVerifiedListener
{
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
    public function handle(EmailVerified $event): void
    {
        $user = $event->user;

        !$user->hasVerifiedEmail() && $user->markEmailAsVerified();
    }
}
