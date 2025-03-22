<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware(['guest', 'locale'])->prefix('v1')->group(function () {
    Route::post('/auth/register', [ApiAuthController::class, 'register']);
    Route::post('/auth/login', [ApiAuthController::class, 'login']);
    Route::post('/auth/forget-password', [ApiAuthController::class, 'forgetPassword']);
    Route::post('/auth/forget-password/check-code', [ApiAuthController::class, 'checkCodeforgetPassword']);
    Route::post('/auth/forget-password/reset', [ApiAuthController::class, 'resetPassword']);
});


Route::prefix('v1')->middleware(['auth:user-api', 'locale'])->group(function () {});
