<?php

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\FrameController;
use App\Http\Controllers\Api\ImageServiceController;
use App\Http\Controllers\Api\MyCartController;
use App\Http\Controllers\Api\NotificaionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PassportController;
use App\Http\Controllers\Api\PostcardController;
use App\Http\Controllers\Api\PosterController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingServiceController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\SoftCopyController;
use App\Http\Controllers\Api\StudioController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthSocialController;
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



Route::middleware(['guest','locale'])->prefix('v1')->group(function(){
    Route::post('/auth/register', [ApiAuthController::class , 'register']);
    Route::post('/auth/login', [ApiAuthController::class , 'login']);
    // Forget Password
    Route::post('/auth/forget/password/sendcode', [ApiAuthController::class , 'forgetPassword']);
    Route::post('/auth/forget/password/checkcode', [ApiAuthController::class , 'checkCodeforgetPassword']);
    Route::post('/auth/forget/password/reset', [ApiAuthController::class , 'resetPassword']);
    // Forget Password
    Route::post('/auth/check-code', [ApiAuthController::class , 'checkCode']);
    Route::post('/auth/resend-code', [ApiAuthController::class , 'reSendVerifiyCode']);
    

    Route::get('/auth/{provider}/redirect',[ApiAuthController::class , 'redirect']);
     


});


Route::prefix('v1')->middleware(['auth:user-api','locale'])->group(function(){

    Route::post('/auth/register/complete', [AuthSocialController::class , 'dataUserAuthSocial']);
    Route::post('/auth/login/social', [ApiAuthController::class , 'loginWithToken']);
    
    // Route::post('/auth/send-code', [ApiAuthController::class , 'sendVerifiyCode']);
    Route::get('auth/logout',[ApiAuthController::class , 'logout']);
    Route::post('auth/fcmtoken/refresh',[ApiAuthController::class , 'refreshFcmToken']);
    Route::post('auth/change/password',[ApiAuthController::class , 'changePassword']);
    Route::put('auth/update/profile',[ApiAuthController::class , 'updateProfile']);
    

    Route::post('user/address',[UserController::class ,'setAddress']);
    Route::post('user/isNotify',[UserController::class ,'isNotify']);
    Route::put('user/address/{user_address}',[UserController::class ,'editAddress']);
    Route::delete('user/address/{user_address}',[UserController::class ,'deleteAddress']);
    Route::get('user/address',[UserController::class ,'getAllAddress']);
    Route::get('user/address/order',[UserController::class ,'getByDefualtAffress']);
    Route::post('user/delete-account',[UserController::class ,'deleteAccount']);

    Route::controller(AppController::class)->group(function(){
        Route::post('app/contact-us','contactUs');
        Route::get('app/about-us','aboutUs');
        Route::get('app/faqs','faqs');
        Route::get('app/privacy','privacy');
        Route::get('app/terms','terms');
        Route::get('app/countries','countries');
        Route::get('app/countries/{country}','getCityByCountry');
        Route::get('app/cities','cities');
    });


    Route::controller(ServicesController::class)->group(function(){
        Route::get('services/all','allServices');
        Route::get('services/{type}/{id}','getObjectService');
        Route::get('services/{type}/{id}/option','getObjectOptionService');
    });

    Route::controller(StudioController::class)->group(function(){
        Route::get('studio/services/all','allServicesStudio');
        Route::get('bookingstudio/{booking_studio_service}/studio/all/user/lat/{lat}/long/{long}','allStudio');
        Route::get('bookingstudio/{booking_studio_service}/studio/{studio_branch}/user/lat/{lat}/long/{long}','singleStudio');
        Route::get('bookingstudio/{booking_studio_service}/studio/services/{id}/user/lat/{lat}/long/{long}','studioByService');
        Route::post('studio/booking','setBooking');
        Route::delete('studio/booking/{studio_booking}','deleteBookgin');
        Route::get('bookingstudio/{booking_studio_service}/studio/booking/{studio_booking}/user/lat/{lat}/long/{long}','getEditBooking');
        Route::post('studio/booking/{studio_booking}/edit','editBooking');

    });

    Route::controller(PassportController::class)->group(function(){
        Route::get('passport/countries','getCountriesActiveServices');
        Route::get('passport/country/{passport_country}/types','getServicePassport');
        Route::get('passport/{passport_service}/country/{passport_country}/type/{passport_type}','getObjectServicePassport');
        Route::get('passport/{passport_service}/country/{passport_country}/type/{passport_type}/booking','getbooking');
        Route::post('passport/booking','setBooking');

        Route::get('passport/{passport_service}/booking/{passport_booking}/edit','getEditBooking');
        Route::post('passport/booking/edit','updateBooking');
    });

    Route::controller(AdsController::class)->group(function(){
        Route::get('ads','getAllAds');
    });


    Route::controller(PostcardController::class)->group(function(){
        Route::get('postcard/{postcard_service}','getSinglePostcard');
        Route::get('postcard/{postcard_service}/sized/{option_postcard_service}/package','getPackage');
        Route::get('postcard/{postcard_service}/sized/{option_postcard_service}/package/{sub_option_postcard_service}/booking','getBooking');
        Route::get('postcard/{postcard_service}/booking/{postcard_booking}/edit','getEditBooking');
        Route::post('postcard/booking/edit','updateBooking');
        Route::post('postcard/booking','setBooking');
    });

    Route::controller(PosterController::class)->group(function(){
        Route::get('poster/{posterprint_service}','getSinglePoster'); // الشاشة الرئيسية
        Route::get('poster/{posterprint_service}/sized/{option_posterprint_service}/package','getPackage'); // البكجات والاختيارات التي بداخل الاحجام
        Route::get('poster/{posterprint_service}/sized/{option_posterprint_service}/package/{packge_poster_service}/choices','getChoisePackage'); // الاختيارات التي بداخل البكجات
        Route::get('poster/{posterprint_service}/sized/{option_posterprint_service}/package/{packge_poster_service}/booking','getBooking');
        Route::post('poster/booking','setBooking');

        Route::get('poster/{posterprint_service}/booking/{poster_booking}/edit','getEditBooking');
        Route::post('poster/booking/edit','updateBooking');
        
    });

    Route::controller(FrameController::class)->group(function(){
        Route::get('frame/{frame_album_service}','getSingleFrame');
        Route::get('frame/{frame_album_service}/option/{option_frame_album_service}/choices','getChoices'); //16. Photo Frames
        Route::get('frame/{frame_album_service}/option/{option_frame_album_service}/choices/{frames_or_album}/deitalis','getDeitalis'); //Details Screen
        Route::get('frame/{frame_album_service}/option/{option_frame_album_service}/choices/{frames_or_album}/booking','getBooking'); 
        Route::post('frame/booking','setbooking'); 

        Route::get('frame/{frame_album_service}/booking/{frameAlbumBookgin}/edit','getEditBooking');
        Route::post('frame/booking/edit','updateBooking');
    });

    Route::controller(SoftCopyController::class)->group(function(){
        Route::post('softcopy/{soft_copy_service}/booking','setBooking');
    });


    Route::controller(MyCartController::class)->group(function(){
        Route::get('mycart','getCartData');
        Route::post('mycart/delete','deleteService');
        Route::post('mycart/add/quantity','quantity');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('products','getBooking');
        Route::post('products','setBooking');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::post('order/softcopy/confirm','confirmSoftcopy');
        Route::post('order/confirm','sendConfirmd');
        Route::get('order/confirm','getConfirm');
        Route::get('orders','getOrders');
        Route::get('order/status','getStatusOrder');
        Route::get('order/status/{order_status}','getOrderByStatus');
        Route::get('order/{order}/details','orderDeatials');
        Route::post('order/studios','getStudios');
        Route::post('order/promocode','dataPromoCode');
        
        
    });

    Route::controller(RatingServiceController::class)->group(function(){
        Route::post('rating/send','sendRate');
        Route::get('rating/poster/{posterprint_service}','getPosterRating');
        Route::get('rating/postcard/{postcard_service}','getPostcardRating');
        Route::get('rating/passport/{passport_service}','getPassportRating');
        Route::get('rating/frame/{frame_album_service}','getFrameRating');
        Route::get('rating/softcopy/{soft_copy_service}','getSoftcopyRating');
        Route::get('rating/studio/{studio_branch}','getStudioRating');
    });

    Route::controller(ImageServiceController::class)->group(function(){
        Route::post('services/image/remove','removeImage');
    });

    Route::controller(NotificaionController::class)->group(function(){
        Route::get('notifications','getNotification');
        
    });
    
});

    
