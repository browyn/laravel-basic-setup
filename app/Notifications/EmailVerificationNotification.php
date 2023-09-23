<?php

namespace App\Notifications;

use App\Enums\HasOtpEnum;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification implements ShouldQueue
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
            ->subject('Verify Your Email Address')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->markdown(
                'mails.email-verification',
                [
                    'user' => $user->email,
                    'otp' => $user->getOtpFor(HasOtpEnum::EMAIL_VERIFICATION)->otp,
                ]
            );
    }
}
