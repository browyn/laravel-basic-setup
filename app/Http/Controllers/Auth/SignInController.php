<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\SignIn;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->all();
        $remember = array_key_exists("remember", $data) && $data['remember'];

        if (!Auth::attempt($data, $remember)) {
            return response()->json([
                'message' => 'Invalid email/password provided',
                'error' => [
                    'email' => 'Invalid email/password provided'
                ]
            ], 422);
        }

        $request->session()->regenerate();

        $user = User::find(auth()->id());
        event(new SignIn($user));

        return response()->json([
            'status' => true,
            'message' => 'Signed in successfully!',
            'data' => $user,
        ], 200);
    }
}
