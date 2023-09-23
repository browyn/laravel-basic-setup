<?php

namespace App\Listeners\Auth;

use App\Events\Auth\SignIn;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SignInListener
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
    public function handle(SignIn $event): void
    {
        $user = $event->user;

        if ($user->requires_2fa) {
            $user->send2faOtp();
        }
    }
}
