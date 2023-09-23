<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->validateData($request);

        $user = User::create($data)->assignRole(UserRoleEnum::CREATOR->value);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Signup successful',
        ], 201);
    }

    public function validateData(Request $request): array
    {
        return $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'username' => ['required', 'string', 'min:3', 'regex:/^[A-Za-z]+$/', 'unique:users,username']
        ]);
    }
}
