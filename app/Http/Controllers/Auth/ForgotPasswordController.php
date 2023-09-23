<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT)
            return response()->json([
                'message' => __($status),
                'error' => [
                    'email' => __($status),
                ],
            ], 422);

        return response()->json([
            'message' => 'Password reset link sent successfully!',
        ], 200);
    }
}
