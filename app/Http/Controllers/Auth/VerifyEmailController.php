<?php

namespace App\Http\Controllers\Auth;

use App\Enums\HasOtpEnum;
use App\Events\Auth\EmailVerified;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function resend(Request $request): Response
    {
        $user = $request->user();

        if ($user->canRequestNewOtpFor(HasOtpEnum::EMAIL_VERIFICATION)) {
            $user->sendEmailVerificationOtp();
        }

        return response()->noContent();
    }

    public function verify(Request $request): Response
    {
        $user = $request->user();

        $user->verifyOtpFor(HasOtpEnum::EMAIL_VERIFICATION, $request->code);
        event(new EmailVerified($user));

        Auth::guard('web')->logout();

        return response()->noContent();
    }
}
