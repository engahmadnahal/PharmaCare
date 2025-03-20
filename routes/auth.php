<?php

use App\Http\Controllers\AboutUsController;
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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware('guest:admin,employee')
            ->group(function () {
                Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
                Route::post('login', [AuthController::class, 'login']);
            });


        Route::middleware('guest:admin,employee')->group(function () {
            Route::get('/forgot-password', [ResetPasswordController::class, 'requestPasswordReset'])->name('password.request');
            Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
            Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
            Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
        });

        Route::prefix('portal/')->middleware('auth:admin,employee')->group(function () {

            Route::post('notification/read', [AuthController::class, 'readNotification']);
            // Store
            Route::get('profile/logo-and-image', [AuthController::class, 'logoAndImage'])->name('cms.profile.logo-and-image');
            Route::put('profile/logo-and-image', [AuthController::class, 'storeImageAndCover']);

            Route::get('profile/category', [AuthController::class, 'showCategory'])->name('cms.profile.category');
            // Route::get('profile/day-work', [AuthController::class, 'editPassword'])->name('cms.profile.day-work');
            Route::get('profile/region-info', [AuthController::class, 'showRegionInfo'])->name('cms.profile.region-info');
            Route::put('profile/region-info', [AuthController::class, 'editRegionInfo']);

            Route::get('profile/personal', [AuthController::class, 'profilePersonalInformatiion'])->name('cms.profile.personal-information');
            Route::put('profile/personal', [AuthController::class, 'updateProfilePersonalInformation'])->name('cms.profile.update-personal-information');

            Route::get('profile/account', [AuthController::class, 'profileAccountInformatiion'])->name('cms.profile.account-information');

            Route::get('profile/change-password', [AuthController::class, 'editPassword'])->name('cms.profile.change-password');

            Route::post('change-password', [AuthController::class, 'updatePassword']);

            Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');
        });
    }
);
