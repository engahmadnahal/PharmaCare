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
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteAccountUserController;
use App\Http\Controllers\DelivaryController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FrameAlbumServiceController;
use App\Http\Controllers\FramesOrAlbumController;
use App\Http\Controllers\FramesSizeController;
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

    Route::prefix('cms')->middleware('guest:admin,studio,studiobranch')->group(function () {
        Route::get('/', [AuthController::class, 'userType']);
        Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('cms.login');
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::prefix('email')->middleware(['auth:admin,studiobranch,studio'])->group(function () {
        Route::get('verify', [VerifyEmailController::class, 'notice'])->name('verification.notice');
        Route::post('verification-notification', [VerifyEmailController::class, 'send'])->middleware(['throttle:6,1'])->name('verification.send');
        Route::get('verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/forgot-password', [ResetPasswordController::class, 'requestPasswordReset'])->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
    });

    Route::prefix('cms/admin/')->middleware(['auth:admin,studio,studiobranch', 'statusUser'])->group(function () {
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
        //  *  Service Studio Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('service_studios', ServiceStudioController::class);

        // /**
        //  * --------------------------------------------
        //  *  Contact Us Route Controller
        //  * --------------------------------------------
        //  */
        Route::post('contact_us/status/change', [ContactUsController::class, 'changeStatus']);
        Route::get('contact_us/{status?}', [ContactUsController::class, 'index'])->name('contact_us.index');
        // Route::resource('contact_us', ContactUsController::class);

        // /**
        //  * --------------------------------------------
        //  *  Service Studio Booking Route Controller
        //  * --------------------------------------------
        //  */



        Route::get('services_booking_studios/services', [ServicesBookingStudioController::class, 'services'])->name('services_booking_studios.services');
        Route::post('services_booking_studios/{studio_branch}/servcies', [ServicesBookingStudioController::class, 'setServices'])->name('services_booking_studios.set_services');
        Route::resource('services_booking_studios', ServicesBookingStudioController::class);

        /**
         * --------------------------------------------
         *  Store House Route Controller
         * --------------------------------------------
         */
        Route::resource('store_houses', StoreHouseController::class);
        /**
         * --------------------------------------------
         *  Store House Route Controller
         * --------------------------------------------
         */
        Route::resource('delete_account_users', DeleteAccountUserController::class);
        /**
         * --------------------------------------------
         *  Store House Route Controller
         * --------------------------------------------
         */
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
        Route::get('products/{product}/distribution', [ProductController::class, 'distribution'])->name('products.distribution');
        Route::get('products/me', [ProductController::class, 'studioProduct'])->name('products.studio');
        Route::post('products/{product}/distribution', [ProductController::class, 'distributionToStudio']);
        Route::resource('products', ProductController::class);
        /**
         * --------------------------------------------
         *  Privecy Route Controller
         * --------------------------------------------
         */

        Route::resource('studios', StudioController::class);
        /**
         * --------------------------------------------
         *  Studio Branches Route Controller
         * --------------------------------------------
         */
        Route::get('studios/{studio_branch}/servcies', [StudioBranchController::class, 'showServices'])->name('studios.show_services');
        Route::post('studios/{studio_branch}/servcies', [StudioBranchController::class, 'setServices'])->name('studios.set_services');
        Route::post('studios/block', [StudioBranchController::class, 'blockStudio'])->name('studios.block');
        Route::resource('studio_branches', StudioBranchController::class);

        /**
         * --------------------------------------------
         *   Delivary Route Controller
         * --------------------------------------------
         */
        Route::resource('delivaries', DelivaryController::class);
        /**
         * --------------------------------------------
         *   Payment gat ways Controller
         * --------------------------------------------
         */
        Route::resource('payment_gat_ways', PaymentGatWayController::class);

        //  /**
        //  * --------------------------------------------
        //  *  Privecy Route Controller
        //  * --------------------------------------------
        //  */
        Route::resource('privecies', PrivecyController::class);
        //  /**
        //  * --------------------------------------------
        //  *  TermUser Route Controller
        //  * --------------------------------------------
        //  */
        Route::controller(TermUserController::class)->group(function () {
            Route::get('term_users', 'index')->name('term_users.index');
            Route::get('term_users/create', 'create')->name('term_users.create');
            Route::get('term_users/{term_user}/edit', 'edit')->name('term_users.edit');
            Route::post('term_users', 'store');
            Route::put('term_users/{term_user}', 'update');
        });
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
         *  FAQS Route Controller
         * --------------------------------------------
         */
        Route::controller(FaqsController::class)->group(function () {
            Route::get('faqs', 'index')->name('faqs.index');
            Route::get('faqs/create', 'create')->name('faqs.create');
            Route::get('faqs/{faqs}/edit', 'edit')->name('faqs.edit');
            Route::post('faqs', 'store')->name('faqs.store');
            Route::put('faqs/{faqs}', 'update')->name('faqs.update');
            Route::delete('faqs/{faqs}', 'destroy')->name('faqs.destroy');
        });

        /**
         * --------------------------------------------
         *  Request Accept Studio Route Controller
         * --------------------------------------------
         */
        Route::controller(RequestAcceptStudioController::class)->group(function () {
            Route::get('request-studio', 'index')->name('request-studio.index');
            Route::get('request-studio/{id}', 'show')->name('request-studio.show');
            Route::post('request-studio/{id}/accept', 'accept')->name('request-studio.accept');
            Route::post('request-studio/{id}/inaccept', 'inAccept')->name('request-studio.inAccept');
        });

        /**
         * --------------------------------------------
         *  Postcard Service Route Controller
         * --------------------------------------------
         */
        Route::resource('postcard_services', PostcardServiceController::class);
        Route::resource('option_postcard_services', OptionPostcardServiceController::class);
        Route::resource('sub_option_postcard_services', SubOptionPostcardServiceController::class);
        /**
         * --------------------------------------------
         *  Poster Printing Route Controller
         * --------------------------------------------
         */
        Route::resource('posterprint_services', PosterprintServiceController::class);
        Route::resource('option_posterprint_services', OptionPosterprintServiceController::class);
        Route::resource('sub_option_posterprint_services', SubOptionPosterprintServiceController::class);
        Route::resource('packge_poster_services', PackgePosterServiceController::class);

        /**
         * --------------------------------------------
         *  Passport Route Controller
         * --------------------------------------------
         */
        Route::get('passport_types/{passport_type}/countries', [PassportTypeController::class, 'showCountries'])->name('passport_types.show_countries');
        Route::post('passport_types/{passport_type}/countries', [PassportTypeController::class, 'setCountries'])->name('passport_types.set_countries');
        Route::resource('passport_types', PassportTypeController::class);
        Route::resource('passport_options', PassportOptionController::class);
        Route::resource('passport_services', PassportServiceController::class);
        Route::resource('passport_countries', PassportCountryController::class);
        /**
         * --------------------------------------------
         *  Frame&Album Route Controller
         * --------------------------------------------
         */
        Route::resource('frame_album_services', FrameAlbumServiceController::class);
        Route::resource('option_frame_album_services', OptionFrameAlbumServiceController::class);
        Route::resource('frames_or_albums', FramesOrAlbumController::class);
        Route::resource('frames_sizes', FramesSizeController::class);
        Route::resource('album_sizes', AlbumSizeController::class);
        Route::resource('qs_frames_albums', QsFramesAlbumController::class);

        /**
         * --------------------------------------------
         *  Booking Studio Services  Route Controller
         * --------------------------------------------
         */

        Route::resource('booking_studio_services', BookingStudioServiceController::class);

        /**
         * --------------------------------------------
         *  SoftCopy Services  Route Controller
         * --------------------------------------------
         */

        Route::resource('soft_copy_services', SoftCopyServiceController::class);


        /**
         * --------------------------------------------
         *  Currency  Route Controller
         * --------------------------------------------
         */

        Route::resource('currencies', CurrencyController::class);

        /**
         * --------------------------------------------
         *  Qs Order Route Controller
         * --------------------------------------------
         */

        Route::resource('qs_date_orders', QsDateOrderController::class);
        Route::resource('qs_general_orders', QsGeneralOrderController::class);
        Route::resource('order_statuses', OrderStatusController::class);

        /**
         * --------------------------------------------
         *  Owner Studio Route Controller
         * --------------------------------------------
         */

        // Route::resource('owner_studios',OwnerStudioController::class);
        /**
         * --------------------------------------------
         *  Order Studio Route Controller
         * --------------------------------------------
         */
        Route::get('order_studios/{type}/{id}/order/{orderId}/detials', [OrderStudioController::class, 'detials'])->name('order_studios.detials');
        Route::get('order_studios/{type}/booking/{bookingId}/user/{userId}/order/{orderId}/download', [OrderStudioController::class, 'download'])->name('order_studios.download');
        Route::get('order_studios/user/{userId}/order/{orderId}/download', [OrderStudioController::class, 'downloadAll'])->name('order_studios.download.all');
        Route::post('order_studios/send-to-studio', [OrderStudioController::class, 'sendToStudio'])->name('order_studios.sendToStudio');
        Route::resource('order_studios', OrderStudioController::class);

        /**
         * --------------------------------------------
         *  Currency  Route Controller
         * --------------------------------------------
         */

        Route::get('ads', [AdsController::class, 'index'])->name('ads.index');
        Route::get('ads/create', [AdsController::class, 'create'])->name('ads.create');
        Route::post('ads', [AdsController::class, 'store'])->name('ads.store');
        Route::get('ads/{ads}/edit', [AdsController::class, 'edit'])->name('ads.edit');
        Route::put('ads/{ads}', [AdsController::class, 'update'])->name('ads.update');
        Route::delete('ads/{ads}', [AdsController::class, 'destroy'])->name('ads.destroy');

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

        

        Route::resource('notification_fcm_users', NotificationFcmUserController::class);

        /**
         * --------------------------------------------
         * Promo Code Route Controller
         * --------------------------------------------
         */
        Route::resource('promo_codes', PromoCodeController::class);
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


// Route::get('/auth/{provider}/callback', [AuthSocialController::class, 'callback'])->name('auth.social.callback');
// Route::get('/auth/{provider}/redirect', [AuthSocialController::class, 'redirect'])->name('auth.social.redirect');


Route::get('/mastercard/callback/handle', [MastercardController::class,'handlePayment'])->name('mastercard.returnUrl');

