<?php

namespace App\Listeners\Auth;

use App\Events\Auth\NewUser;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewUserListener
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
    public function handle(NewUser $event): void
    {
        $user = $event->user;

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationOtp();
        }
    }
}
