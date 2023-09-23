<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InvalidOrExpiredOtp extends Exception
{

    public function render(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'message' => $this->message,
                'error' => [
                    'code' => $this->message,
                ],
            ], $this->code);
        }
    }
}
