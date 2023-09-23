<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\PasswordReset;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $this->validateData($request);

        $status = Password::reset(
            [...$credentials, ...$request->only('email', 'token')],
            function (User $user) use ($credentials) {
                $user->forceFill([
                    'password' => $credentials["password"],
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Unable to process request',
                'error' => [
                    'password' => __($status)
                ]
            ], 500);
        }

        return response()->json([
            'message' => 'Password reset successfully!',
        ], 200);
    }

    protected function validateData(Request $request)
    {
        return $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
