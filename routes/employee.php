<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employee\CouponController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeRoleController;
use App\Http\Controllers\Employee\EmployeeRolePermissionController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\Employee\ProductController;
use App\Http\Controllers\Employee\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::prefix('cms/employee')
        ->middleware('auth:employee')
        ->name('cms.employee.')
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('cms.dashboard');
            Route::get('/lang', [DashboardController::class, 'changeLanguage'])->name('cms.dashboard.language');

            /*
            |--------------------------------------------------------------------------
            | Roles & Permissions Routes
            |--------------------------------------------------------------------------
            */

            Route::resource('roles', EmployeeRoleController::class);

            Route::controller(EmployeeRolePermissionController::class)->group(function () {
                Route::get('permissions/role/{id}', 'show')->name('permissions.role.show');
                Route::post('permissions/role', 'store')->name('permissions.role.store');
            });

            // /**
            //  * --------------------------------------------
            //  *  Employee Route Controller
            //  * --------------------------------------------
            //  */
            Route::resource('employees', EmployeeController::class);

            // /**
            //  * --------------------------------------------
            //  *  Coupon Route Controller
            //  * --------------------------------------------
            //  */
            Route::resource('coupons', CouponController::class);

            // /**
            //  * --------------------------------------------
            //  *  Product Route Controller
            //  * --------------------------------------------
            //  */

            Route::resource('products', ProductController::class);

            // /**
            //  * --------------------------------------------
            //  *  Order Route Controller
            //  * --------------------------------------------
            //  */
            Route::resource('orders', OrderController::class);
            Route::put('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');

            // /**
            //  * --------------------------------------------
            //  *  User Route Controller
            //  * --------------------------------------------
            //  */
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::put('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status.update');


        });
});
