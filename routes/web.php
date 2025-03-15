<?php

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AlbumSizeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthSocialController;
use App\Http\Controllers\BookingStudioServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteAccountUserController;
use App\Http\Controllers\DelivaryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FrameAlbumServiceController;
use App\Http\Controllers\FramesOrAlbumController;
use App\Http\Controllers\FramesSizeController;
use App\Http\Controllers\MedicineTypeController;
use App\Http\Controllers\NotificationFcmUserController;
use App\Http\Controllers\OptionFrameAlbumServiceController;
use App\Http\Controllers\OptionPostcardServiceController;
use App\Http\Controllers\OptionPosterprintServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\OrderStudioController;
use App\Http\Controllers\PackgePosterServiceController;
use App\Http\Controllers\PassportCountryController;
use App\Http\Controllers\PassportOptionController;
use App\Http\Controllers\PassportServiceController;
use App\Http\Controllers\PassportTypeController;
use App\Http\Controllers\Payment\MastercardController;
use App\Http\Controllers\PaymentGatWayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PharmaceuticalController;
use App\Http\Controllers\PostcardServiceController;
use App\Http\Controllers\PosterprintServiceController;
use App\Http\Controllers\PrivecyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\QsDateOrderController;
use App\Http\Controllers\QsFramesAlbumController;
use App\Http\Controllers\QsGeneralOrderController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestAcceptStudioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ServicesBookingStudioController;
use App\Http\Controllers\ServiceStudioController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SoftCopyServiceController;
use App\Http\Controllers\StoreHouseController;
use App\Http\Controllers\StudioBranchController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\SubOptionPostcardServiceController;
use App\Http\Controllers\SubOptionPosterprintServiceController;
use App\Http\Controllers\TermUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
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

    Route::prefix('cms')->middleware('guest:admin')->group(function () {
        Route::get('/', [AuthController::class, 'userType']);
        Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
        Route::post('login', [AuthController::class, 'login']);
    });


    Route::middleware('guest')->group(function () {
        Route::get('/forgot-password', [ResetPasswordController::class, 'requestPasswordReset'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
    });

    Route::prefix('cms/admin/')->middleware(['auth:admin'])->group(function () {
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
        Route::resource('countries', CountryController::class);
        // /**
        //  * --------------------------------------------
        //  *  City Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('cities', CityController::class);
        // /**
        //  * --------------------------------------------
        //  *  Region Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('regions', RegionController::class);
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
        Route::get('contact_us/{status?}', [ContactUsController::class, 'index'])->name('contact_us.index');

        Route::post('users/block', [UserController::class, 'blockUser']);
        Route::resource('users', UserController::class);


        /**
         * --------------------------------------------
         *  Setting Route Controller
         * --------------------------------------------
         */
        Route::resource('settings', SettingController::class);

        /**
         * --------------------------------------------
         *  Products Route Controller
         * --------------------------------------------
         */
        // Route::get('products/{product}/distribution', [ProductController::class, 'distribution'])->name('products.distribution');
        // Route::get('products/me', [ProductController::class, 'studioProduct'])->name('products.studio');
        // Route::post('products/{product}/distribution', [ProductController::class, 'distributionToStudio']);
        // Route::resource('products', ProductController::class);
        

        
        /**
         * --------------------------------------------
         *  AboutUs Route Controller
         * --------------------------------------------
         */
        Route::controller(AboutUsController::class)->group(function () {
            Route::get('about_us', 'index')->name('about_us.index');
            Route::get('about_us/create', 'create')->name('about_us.create');
            Route::get('about_us/{about_us}/edit', 'edit')->name('about_us.edit');
            Route::post('about_us', 'store')->name('about_us.store');
            Route::put('about_us/{about_us}', 'update')->name('about_us.update');
        });


        /**
         * --------------------------------------------
         *  Currency  Route Controller
         * --------------------------------------------
         */

        Route::resource('currencies', CurrencyController::class);

      

        /**
         * --------------------------------------------
         *  Owner Studio Route Controller
         * --------------------------------------------
         */

        // Route::resource('owner_studios',OwnerStudioController::class);
        

       

        /**
         * --------------------------------------------
         *  SoftCopy Order  Route Controller
         * --------------------------------------------
         */

        Route::controller(OrderController::class)->group(function () {
            Route::get('order/softcopy', 'indexSoftCopy')->name('order.softcopy');
            Route::get('order/softcopy/{softcopy_booking}/detials', 'detials')->name('order.softcopy.detials');
            Route::get('order/softcopy/{bookingId}/{userId}/download', 'download')->name('order.softcopy.download');
            Route::post('order/softcopy/{softcopy_booking}/accepted', 'accepted')->name('order.softcopy.accepted');
            Route::post('order/change-status', 'changeStatus');
        });

         /**
         * --------------------------------------------
         *  Reports Route Controller
         * --------------------------------------------
         */

        Route::controller(ReportController::class)->group(function () {
            Route::get('reports/order-status', 'orderStatusReportIndex')->name('reports.order.status');
            Route::get('reports/order-status-excel', 'orderStatusReportExcel')->name('reports.order.status.excel');

            Route::get('reports/studio-performance', 'studioPerformanceReportIndex')->name('reports.studio.performance');
            Route::get('reports/studio-performance-excel', 'studioPerformanceReportExcel')->name('reports.studio.performance.excel');

            Route::get('reports/details-services-sales', 'detailsServicesSalesReportIndex')->name('reports.details.sales');
            Route::get('reports/details-services-sales-excel', 'detailsServicesSalesReportExcel')->name('reports.details.sales.excel');

            Route::get('reports/area-performance', 'areaPerformanceReportIndex')->name('reports.area.performance');
            Route::get('reports/area-performance-excel', 'areaPerformanceReportExcel')->name('reports.area.performance.excel');


            Route::get('reports/order-faild', 'orderFaildReportIndex')->name('reports.order.faild');
            Route::get('reports/order-faild-excel', 'orderFaildReportExcel')->name('reports.order.faild.excel');

            
            Route::get('reports/services-report', 'servicesReportIndex')->name('reports.services');
            Route::get('reports/services-report-excel', 'servicesReportExcel')->name('reports.services.excel');

             
            Route::get('reports/stock-balance', 'stockBalanceReportIndex')->name('reports.stock.balance');
            Route::get('reports/stock-balance-excel', 'stockBalanceReportExcel')->name('reports.stock.balance.excel');

            Route::get('reports/clearance', 'clearanceReportIndex')->name('reports.clearance');
            Route::get('reports/clearance-excel', 'clearanceReportExcel')->name('reports.clearance.excel');

            Route::get('reports/financial-cash', 'financialCashReportIndex')->name('reports.financial.cash');
            Route::get('reports/financial-cash-excel', 'financialCashReportExcel')->name('reports.financial.cash.excel');
            
            Route::get('reports/financial-online', 'financialOnlineReportIndex')->name('reports.financial.online');
            Route::get('reports/financial-online-excel', 'financialOnlineReportExcel')->name('reports.financial.online.excel');

            Route::get('reports/performance', 'performanceReportIndex')->name('reports.performance');
            Route::get('reports/performance-excel', 'performanceReportExcel')->name('reports.performance.excel');
            
        });

        

   
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::prefix('cms/admin/')->middleware('auth:admin,studio,studiobranch')->group(function () {

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

