<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'current_password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid parameters provided',
                'error' =>  Arr::undot($e->validator->errors()->getMessages()),
            ], 422);
        });

        $this->renderable(function (TooManyRequestsHttpException $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ], $e->getCode());
        });

        $this->renderable(function (UnauthorizedException $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ], $e->getCode());
        });

        $this->renderable(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ], 404);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage(),
            ], 404);
        });
    }
}
