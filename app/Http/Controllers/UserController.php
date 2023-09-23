<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request, ?User $user = null): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'User Fetched Successfully',
            'data' => ($user ?? $request->user()),
        ], 200);
    }
}
