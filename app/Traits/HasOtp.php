<?php

namespace App\Traits;

use App\Exceptions\InvalidOrExpiredOtp;
use Illuminate\Support\Str;
use App\Enums\HasOtpEnum;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

trait HasOtp
{
    public function generateOtpFor(HasOtpEnum $for): void
    {
        $this->otp()->updateOrCreate([
            'user_id' => $this->id,
            'for' => $for,
        ], [
            'otp' => Str::random(6),
            'expires' => now()->addMinutes(6),
        ]);
    }

    public function verifyOtpFor(HasOtpEnum $for, string $otp): bool
    {
        $userOtp = $this->getOtpFor($for);

        if ($userOtp && $userOtp->otp === $otp) {
            if ($userOtp->expires > now()) {
                $userOtp->delete();
                return true;
            }
        }

        throw new InvalidOrExpiredOtp('Invalid OTP provided', 422);
    }


    public function hasVerifiedOtpFor(HasOtpEnum $for): bool
    {
        return is_null($this->getOtpFor($for)) ? true : false;
    }

    public function canRequestNewOtpFor(HasOtpEnum $for)
    {

        $userOtp = $this->getOtpFor($for);

        if (!$userOtp && !$this->hasVerifiedEmail()) {
            return true;
        }

        if (now() < $userOtp->updated_at->addMinutes(1)) {
            throw new TooManyRequestsHttpException(5, 'Please wait before requesting new code', null, 429);
        }

        return true;
    }

    public function getOtpFor(HasOtpEnum $for)
    {
        return $this->otp()->where('for', $for)->first();
    }
}
