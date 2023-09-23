<?php

namespace App\Providers;

use App\Events\Auth\EmailVerified;
use App\Events\Auth\NewUser;
use App\Events\Auth\PasswordReset;
use App\Events\Auth\SignIn;
use App\Listeners\Auth\EmailVerifiedListener;
use App\Listeners\Auth\NewUserListener;
use App\Listeners\Auth\PasswordResetListener;
use App\Listeners\Auth\SignInListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        NewUser::class => [
            NewUserListener::class,
        ],
        EmailVerified::class => [
            EmailVerifiedListener::class,
        ],
        PasswordReset::class => [
            PasswordResetListener::class,
        ],
        SignIn::class => [
            SignInListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
