<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

include_once(__DIR__ . '/route_includes/auth.php');
include_once(__DIR__ . '/route_includes/user.php');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::fallback(function () {
    throw new NotFoundHttpException('The resource you are looking for cannot be found!');
});
