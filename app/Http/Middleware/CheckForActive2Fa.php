<?php

namespace App\Http\Middleware;

use App\Enums\HasOtpEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForActive2Fa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->requires_2fa && !$user->hasVerifiedOtpFor(HasOtpEnum::TWO_FACTOR_AUTHENTICATION)) {
            return response()->json([
                'message' => '2FA Required',
                'error' => '2fa',
            ], 403);
        }

        return $next($request);
    }
}
