<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MedicineTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PharmaceuticalController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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

    Route::prefix('cms/admin')->middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('cms.dashboard');
        Route::get('/lang', [DashboardController::class, 'changeLanguage'])->name('cms.dashboard.language');

        /*
        |--------------------------------------------------------------------------
        | Roles & Permissions Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('permissions/role', RolePermissionController::class);

        // /**
        //  * --------------------------------------------
        //  *  Admin Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('admins', AdminController::class);

        // /**
        //  * --------------------------------------------
        //  *  Category Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('categories', CategoryController::class);
        Route::resource('medicine-types', MedicineTypeController::class);
        // /**
        //  * --------------------------------------------
        //  *  Country Route Controller
        //  * --------------------------------------------
        //  */
        // Route::resource('countries', CountryController::class);
        // // /**
        // //  * --------------------------------------------
        // //  *  City Route Controller
        // //  * --------------------------------------------
        // //  */
        // Route::resource('cities', CityController::class);
        // // /**
        // //  * --------------------------------------------
        // //  *  Region Route Controller
        // //  * --------------------------------------------
        // //  */
        // Route::resource('regions', RegionController::class);
        // /**
        //  * --------------------------------------------
        //  *  Doctor Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('employees', EmployeeController::class);
        // /**
        //  * --------------------------------------------
        //  *  Pharmaceutical Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('pharmaceuticals', PharmaceuticalController::class);

        // /**
        //  * --------------------------------------------
        //  *  Contact Us Route Controller
        //  * --------------------------------------------
        //  */
        // Route::get('contact_us/{status?}', [ContactUsController::class, 'index'])->name('contact_us.index');


        // /**
        //  * --------------------------------------------
        //  *  User Route Controller
        //  * --------------------------------------------
        //  */
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status.update');

        // /**
        //  * --------------------------------------------
        //  *  Order Route Controller
        //  * --------------------------------------------
        //  */
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');


        /**
         * --------------------------------------------
         *  Setting Route Controller
         * --------------------------------------------
         */
        // Route::resource('settings', SettingController::class);


        /**
         * --------------------------------------------
         *  Currency  Route Controller
         * --------------------------------------------
         */

        // Route::resource('currencies', CurrencyController::class);
    });
});
