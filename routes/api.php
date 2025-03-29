<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PharmaController;
use App\Http\Controllers\Api\ProductController;
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

    Route::post('/auth/logout', [ApiAuthController::class, 'logout']);

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

    Route::controller(ProductController::class)
        ->prefix('products')
        ->group(function () {
            Route::get('/', 'index');
            Route::post('toggle-favorite/{id}', 'toggleFavorite');
            Route::post('rate/{id}', 'rateProduct');
            Route::get('favorites', 'getFavorites');
            Route::get('{id}', 'show');
        });

    Route::controller(CategoryController::class)
        ->prefix('categories')
        ->group(function () {
            Route::get('/', 'index');
            Route::get('{category}/products', 'products');
        });

    Route::controller(CartController::class)
        ->prefix('cart')
        ->group(function () {
            Route::get('/', 'showCart');
            Route::post('add', 'addToCart');
            Route::delete('remove-item/{id}', 'removeFromCart');
            Route::put('update-quantity/{id}', 'updateCartQuantity');
            Route::delete('clear', 'clearCart');
            Route::post('apply-coupon', 'applyCoupon');
            Route::post('checkout', 'checkout');
        });

    Route::controller(PharmaController::class)
        ->prefix('pharmacies')
        ->group(function () {
            Route::get('/', 'index');
        });
});
