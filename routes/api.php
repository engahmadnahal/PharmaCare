<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\UserController;
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


Route::prefix('v1')->middleware(['auth:user-api', 'locale'])->group(function () {

    Route::controller(UserController::class)
        ->prefix('user')
        ->group(function () {
            // Profile
            Route::get('/profile', 'profile');
            Route::post('/profile/update', 'updateProfile');
            // Childrens
            Route::post('/childrens', 'addChild');
            Route::get('/childrens', 'getChildren');
            Route::put('/childrens/{id}', 'updateChild');
            // Orders
            Route::get('/orders', 'orders');
            // Medical Records
            Route::get('/disease-type', 'getDiseaseType');
            Route::post('medical-records', 'createMedicalRecord');
            Route::get('medical-records', 'getMedicalRecords');
            Route::post('medical-records/{id}', 'updateMedicalRecord');
            Route::delete('medical-records/{id}', 'deleteMedicalRecord');
            // Drugs
            Route::post('drugs', 'createDrug');
            Route::get('drugs', 'getDrugs');
            Route::post('drugs/{id}', 'updateDrug');
            Route::delete('drugs/{id}', 'deleteDrug');
        });
});
