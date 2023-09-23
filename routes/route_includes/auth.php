<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function () {
        Route::post('/signup', SignUpController::class);
        Route::post('/signin', SignInController::class);
        Route::post('/reset-password', ResetPasswordController::class)->name('password.reset');
        Route::post('/forgot-password', ForgotPasswordController::class)->name('password.forgot');
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        // EMAIL VERIFICATION
        Route::post('/email-verification/resend', [VerifyEmailController::class, 'resend']);
        Route::post('/email-verification/verify', [VerifyEmailController::class, 'verify']);

        // TWO FACTOR AUTHENTICATION
        Route::post('/2fa/resend', [TwoFactorAuthenticationController::class, 'resend']);
        Route::post('/2fa/verify', [TwoFactorAuthenticationController::class, 'verify']);

        // LOGOUT
        Route::get('/logout', LogoutController::class);
    });
