<?php

namespace App\Traits;

use App\Enums\HasOtpEnum;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\TwoFactorAuthenticationNotification;

trait UserHelper
{
    public function sendEmailVerificationOtp()
    {
        $this->generateOtpFor(HasOtpEnum::EMAIL_VERIFICATION);
        $this->notify(new EmailVerificationNotification());
    }

    public function send2faOtp()
    {
        $this->generateOtpFor(HasOtpEnum::TWO_FACTOR_AUTHENTICATION);
        $this->notify(new TwoFactorAuthenticationNotification());
    }
}
