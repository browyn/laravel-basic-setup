<?php

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/{user?}', [UserController::class, 'show']);
    });
