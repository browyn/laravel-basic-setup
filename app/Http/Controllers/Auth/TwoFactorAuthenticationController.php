<?php

namespace App\Http\Controllers\Auth;

use App\Enums\HasOtpEnum;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TwoFactorAuthenticationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function resend(Request $request): Response
    {
        $user = $request->user();

        if ($user->requires_2fa && $user->canRequestNewOtpFor(HasOtpEnum::TWO_FACTOR_AUTHENTICATION)) {
            $user->send2faOtp();
        }

        return response()->noContent();
    }

    public function verify(Request $request): Response
    {
        $user = $request->user();

        $user->verifyOtpFor(HasOtpEnum::TWO_FACTOR_AUTHENTICATION, $request->code);

        return response()->noContent();
    }
}
