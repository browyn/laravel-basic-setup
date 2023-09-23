<?php

namespace App\Notifications;

use App\Enums\HasOtpEnum;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Enums\UserOtpEnum;

class TwoFactorAuthenticationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable): MailMessage
    {
        $user = $notifiable;

        return (new MailMessage)
            ->subject('Two Factor Authentication')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->markdown(
                'mails.two-factor-authentication',
                [
                    'user' => $user->email,
                    'otp' => $user->getOtpFor(HasOtpEnum::TWO_FACTOR_AUTHENTICATION)->otp,
                ]
            );
    }
}
