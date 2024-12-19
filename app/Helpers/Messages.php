<?php

/**
 * Created by PhpStorm.
 * User: momensisalem
 * Date: 2019-03-20
 * Time: 20:48
 */

namespace App\Helpers;

class Messages
{
    private static $arMessages = [

        "SUCCESS_PAY" => "تم الدفع بنجاح",
        'ERROR_PAY' => 'حدث مشكلة اثناء الدفع',
        'STOCK_NOT_ENOUGH' => 'الكمية غير كافية',
        // Business Logic
        'SUCCESS_GET' => 'تم الجلب بنجاح',
        'SUCCESS_SEND' => 'تم الارسال بنجاح',
        'SUCCESS_EDIT' => 'تم التحديث بنجاح',
        'SUCCESS_DELETE' => 'تم الحذف بنجاح',
        'SUCCESS' => 'تم بنجاح',

        'ERROR_GET' => 'حدث خطأ أثناء جلب البيانات',
        'ERROR_SEND' => 'حدث خطأ أثناء الارسال',
        'ERROR_DELETE' => 'حدث خطأ أثناء الحذف',
        'ERROR' => 'حدث خطأ',
        'YOUR_STORE_BLOCK' => 'لقد حظرت هذا المتجر ',
        'NO_RESULTS' => 'لايوجد نتائج',
        'SUCCESS_SUBSC' => 'تم الاشتراك بنجاح',
        'SUCCESS_CONTACT_SEND' => 'تم الارسال بنجاح ، سيتم الرد عليك في وقت قريب',
        "SHOULD_CONFIRM_ORDER" => "يجب اكمال الطلب اولا",
        'MUST_HAS_DEFAULT_ADDRESS' => 'يجب ان يكون لديك عنوان واحد على الاقل',
        
        //AUTH
        'REGISTERED_SUCCESSFULLY' => 'تم إنشاء الحساب ينجاح',
        'REGISTER_FAILED' => 'فشلت عملية إنشاء حساب جديد, حاول من جديد',
        'REGISTRATION_FAILED' => 'فشلت عملية إنشاء الحساب!',
        'BLOCKED_DEVICE' => 'تم حظر الحساب!',
        'REGISTRATION_CLOSED' => 'تم إغلاق التسجيل من قبل الإدارة',
        'AUTH_CODE_ERROR' => 'رمز التفعيل غير صحيح, حاول مرة أخرى',
        'AUTH_CODE_SENT_BEFORE' => 'تم إرسال رمز التفعيل مسبقا, الرجاء مراجعة الرسائل الواردة من فُل',
        'NO_AUTH_CODE' => 'العملية غير صحيحة!',
        'UNAUTHORISED' => 'لا يوجد لديك صلاحيات, قم بتسجيل الدخول',
        'FORBIDDEN' => 'لا تملك صلاحية',
        'IN_ACTIVE_ACCOUNT' => 'يحب تفعيل الحساب لتمكين تسجيل الدخول!',
        'BLOCK_ACCOUNT' => 'هذا الحساب محظور ',
        'ERROR_CREDENTIALS' => 'بيانات تسجيل الدخول غير صحيحة!, تأكد و حاول مرة أخرى',
        'LOGGED_OUT_SUCCESSFULLY' => 'تم تسجيل الخروج بنجاح',
        'LOGGED_OUT_FAILED' => 'فشل تسجيل الخروج, حاول مرة ثانية',
        'LOGGED_IN_SUCCESSFULLY' => 'تم تسجيل الدخول بنجاح',
        'LOGIN_IN_FAILED' => 'تعذر تسجيل الدخول, حاول مرة أخرى',
        'NO_ACCOUNT' => 'رقم الهاتف المدخل غير مسجل!',
        'ACCOUNT_EXIST' => 'البريد الإلكتروني المدخل مسجل مسبقا!',
        'MOBILE_EXIST' => 'الجوال المدخل المدخل مسجل مسبقا!',
        'AUTH_CODE_SENT' => 'تم إرسال رمز التفعيل بنجاح',
        'SUCCESS_AUTH' => 'تم تفعيل الحساب بنجاح',
        'FAILED_AUTH' => 'فشل تفعيل الحساب, حاول مجدداً',
        'VERIFIED_BOFORE' => 'تم تفعيل الحساب مسبقاً, العملية مرفوضة',
        'NOT_VERIFIED' => 'يجب تفعيل الحساب لتتمكن من تنفيذ اي عملية عليه.',
        'SUCCESS_CHECKED' => 'تم التحقق بنجاح',
        'FAILD_CHECKED' => 'فشل التحقق',
        'DELETED_AFTER_24_H' => 'سيتم حذف الحساب بعد 24 ساعة في حال عدم وجود اي طلبات لك ',

        //PASSWORD
        'ERROR_PASSWORD' => 'كلمة المرور غير صحيحة ',
        'FORGET_PASSWORD_SUCCESS' => 'تم إرسال رمز الإستعادة بنجاح',
        'FORGET_PASSWORD_FAILED' => 'فشل في إرسال رمز الإستعادة!',
        'PASSWORD_RESET_CODE_CORRECT' => 'رمز الإستعادة صحيح, قم بتعين كلمة مرور جديدة',
        'PASSWORD_RESET_CODE_ERROR' => 'رمز الإستعادة غير صحيح, حاول مرة أخرى',
        'NO_PASSWORD_RESET_CODE' => 'لا يوجد طلب إستعادة لكلمة المرور, العملية مرفوضة',
        'PASS_RESET_CODE_SENT_BEFORE' => 'تم إرسال رمز إستعادة كلمة المرور مسبقا, الرجاء مراجعة الرسائل الواردة',

        'RESET_PASSWORD_SUCCESS' => 'تم إستعادة كلمة المرور بنجاح',
        'RESET_PASSWORD_FAILED' => 'فشلت إستعادة كلمة المرور!',

        'CHANGE_PASSWORD_SUCCESS' => 'تم تعديل كلمة المرور بنجاح',
        'CHANGE_PASSWORD_FAILED' => 'فشل تعديل كلمة المرور!',

        'CONTACT_US_REQUEST_SUCCESS' => 'تم إرسال طلبك بنجاح, شكرا لك',
        'CONTACT_US_REQUEST_FAILED' => 'فشل في إرسال الطلب, حاول مرة أخرى',

        'USER_UPDATED_SUCCESS' => 'تم تعديل الحساب بنجاح',
        'USER_UPDATED_FAILED' => 'فشل تعديل الحساب!, حاول مرة اخرى',

        'PASSWORD_SENT' => 'تم إرسال كلمة المرور بنجاح, إستخدمها لتسجيل الدخول الى حسابك',
        'PASSWORD_SEND_FAILED' => 'فشل في إرسال كلمة المرور, حاول مرة أٌخرى',
        'PASSWORD_ALREADY_SET' => 'لقد تم تعيين كلمة المرور مسبقاً!',
        'PASSWORD_NOT_SET' => 'قم بطلب كلمة المرور لحسابك!',
        'CURRENT_PASSWORD_ERROR' => 'كلمة المرور الحالية غير متطابقة',

        'MULTI_ACCESS_ERROR' => 'لا يمكن تسجيل الدخول إلى نفس الحساب من جهازين في نفس الوقت',
        'SECURITY_CHECK_SUCCESS' => 'تم إرسال حالتك بنجاح ، حافظ على سلامتك',
        'SECURITY_CHECK_DUPLICATE' => 'لقد قمت بإرسال حالتك سابقاً ، حافظ على سلامتك',
        'SECURITY_CHECK_FAILED' => 'حصل خلل في إرسال حالتك ،رجاءاً حاول مرة أُخرى',

        'CREATE_SUCCESS' => 'تم الإنشاء بنجاح',
        'CREATE_FAILED' => 'فشلت عملية الإنشاء, حاول مرة أُخرى',

        'DELETE_SUCCESS' => 'تم الحذف بنجاح',
        'DELETE_FAILED' => 'فشلت عملية الحذف, حاول مرة أُخرى',

        'UPDATE_SUCCESS' => 'تم التعديل بنجاح',
        'UPDATE_FAILED' => 'فشلت عملية التعديل, حاول مرة أُخرى',

        'NO_ACCESS_PERMISSION' => 'ليس لديك صلاحية وصول لهذا العنصر',
        'UN_AUTHORIZED_ACTION' => 'ليس لديك صلاحية لتنفيذ هذه العملية',
        'NOT_FOUND' => 'العنصر غير موجود',

        'FAVORITE_ADD' => 'تم اضافة المنتج للمفضلة بنجاح',
        'FAVORITE_REMOVED' => 'تم حذف المنتج من المفضلة بنجاح',
        'FAVORITE_FAILED' => 'فشلت العملية, حاول مجدداً',

        'RATE_ADD' => 'تم تقييم المنتج بنجاح',
        'RATE_UPDATED' => 'تم تعديل تقييم المنتج بنجاح',
        'RATE_FAILED' => 'فشلت العملية, حاول مجدداً',

        'ORDER_CREATED' => 'تم ارسال طلبك بنجاح، سيتم تنبيهك في كل تجديد في الحالة الخاصة به',
        'ORDER_FAILED' => 'حصل خلل في إنشاء الطلب، حاول مرة ثانية',

        // Messages Business

        'MOBILE_USED' => 'الهاتف مستخدم من قبل',
        'EMAIL_USED' => 'الايميل مستخدم من قبل',
        'ERROR_BOOKING' => 'حدث خطأ اثناء الحجز ، تأكد من صحة البيانات والصور',
        'SUCCESS_ORDER' => 'تم ارسال الطلب بنجاح',
        'ERROR_ORDER' => 'حدث خطأ اثناء ارسال الطلب ',
        'CART_IS_EMPTY' => 'سلتك فارغة لايوجد اي حجوزات',
        'ERROR_ORDER_DATE' => 'حدث خطأ اثناء ارسال الطلب تأكد من صحة البيانات المدخلة',
        'NO_ACCESS_ADDRESS' => 'العنوان المحدد ليس لك',
        'ERROR_COPIS_PHOTO' => ' تأكد من ادخال معلومات في عدد الصور والنسخ ',
        'ERROR_QUANTITY' => ' تأكد من ادخال قيمة في كمية الصور ',
        'ERROR_MAX_PHOTO_NUM' => ' عدد الصور المختار ، اكثر من البكج المختارة ',
        'SET_DEFUALT_ADDRESS' => 'يجب ان تملك على الاقل عنوان واحد رئيسي',
        'ACCEPT_FAILED' => 'حدث خطأ أثناء قبول الطلب ',
        'ACCEPT_SUCCESS' => 'تم قبول الطلب بنجاح',
        'ERROR_LOAD_CART' => 'حدث خطأ اثناء تحميل السلة',
        'PROMO_EXPIRED' => 'كود الخصم غير صالح',

        'INVALID_ACTION' => 'العملية غير مسموح بها',
        'ALREAY_DELETE_REQUEST' => 'يوجد طلب مقدم بالفعل',
        'ACCOUNT_DELETED' => 'الحساب محذوف',
        'LIMIT_USE_PROMO' => 'السلة تحت الملبغ المطلوب لاستخدام السلة',
        'CHECK_DATA_PATMENT' => "تأكد من صحة بيانات الدفع رجاءً",
        'ERROR_SAVE_PAYMENT_DATA' => 'حدث خطأ اثناء حفظ معلومات الدفع',
        'ERROR_CONNENCTION_IN_PAYMENT_GETWAY' => 'حدثت مشكلة في الاتصال مع بوابة الدفع',
        "THIS_ORDER_IS_PAYED" => "الطلب تم دفعه"


    ];

    private static $enMessages = [
        "SUCCESS_PAY" => 'Successfully Pay',
        "ERROR_PAY" => 'Successfully Pay',
        'STOCK_NOT_ENOUGH' => 'The quantity is not enough',
        // Business Logic
        'SUCCESS_GET' => 'Successfully get',
        'SUCCESS_SEND' => 'Successfully send',
        'SUCCESS' => 'Successfully',
        'SUCCESS_EDIT' => 'Edit is successfully',
        'SUCCESS_DELETE' => 'Delete is successfully',
        'SUCCESS_CONTACT_SEND' => 'Sent successfully, we will reply to you shortly',

        'ERROR_GET' => 'Error get',
        'ERROR_SEND' => 'Error send',
        'ERROR_DELETE' => 'An error occurred while deleting',
        'YOUR_STORE_BLOCK' => 'You have banned this store',
        'NO_RESULTS' => 'No results',
        'SUCCESS_SUBSC' => 'Subscribed successfully',
        'MUST_HAS_DEFAULT_ADDRESS' => 'You must have at least one address',

        //AUTH
        'REGISTERED_SUCCESSFULLY' => 'Account created successfully',
        'REGISTER_FAILED' => 'Failed to create new account, try again',
        'BLOCKED_DEVICE' => 'Account is blocked',
        'REGISTRATION_CLOSED' => 'Registration closed by system admin',
        'AUTH_CODE_ERROR' => 'Activation code error, try again',
        'AUTH_CODE_SENT_BEFORE' => 'Auth code sent before, please check ful messages in inbox!',
        'NO_AUTH_CODE' => 'Process denied, incorrect',
        'UNAUTHORISED' => 'Unauthorised, please login',
        'IN_ACTIVE_ACCOUNT' => 'Account must be activated to enable login!',
        'BLOCK_ACCOUNT' => 'This Account is blocked',
        'ERROR_CREDENTIALS' => 'Error login credentials, check and try again',
        'LOGGED_OUT_SUCCESSFULLY' => 'Logged out successfully',
        'LOGGED_OUT_FAILED' => 'Logout failed, please try again',
        'LOGGED_IN_SUCCESSFULLY' => 'Great, Logged in successfully',
        'LOGIN_IN_FAILED' => 'Login failed, try again!',
        'NO_ACCOUNT' => 'User Mobile not registered!',
        'FORBIDDEN' => 'FORBIDDEN',
        'AUTH_CODE_SENT' => 'Auth code sent successfully',
        'ACCOUNT_EXIST' => 'Email registered before!',
        'MOBILE_EXIST' => 'Mobile registered before!',
        'SUCCESS_AUTH' => 'Account activated successfully',
        'FAILED_AUTH' => 'Account activation failed, try again',
        'VERIFIED_BOFORE' => 'Account has been verified before, rejected action!',
        'AUTH_CODE_RESENT' => 'Account has been verified before, rejected action!',
        'NOT_VERIFIED' => 'Account must verified to enable any action on it.',
        'SUCCESS_CHECKED' => 'Successfully Checked',
        'FAILD_CHECKED' => 'Faild Checked',


        //PASSWORD
        'ERROR_PASSWORD' => 'The password is incorrect',
        'FORGET_PASSWORD_SUCCESS' => 'Password reset code sent successfully',
        'FORGET_PASSWORD_FAILED' => 'Failed to sent password reset code!',
        'PASSWORD_RESET_CODE_CORRECT' => 'Correct password reset code, set new password',
        'PASSWORD_RESET_CODE_ERROR' => 'Password reset code error, try again',
        'NO_PASSWORD_RESET_CODE' => 'No forget password request exist, process denied!',
        'PASS_RESET_CODE_SENT_BEFORE' => 'Password reset code sent before, please check ful messages in inbox!',

        'RESET_PASSWORD_SUCCESS' => 'Reset password success',
        'RESET_PASSWORD_FAILED' => 'Failed to reset password!',

        'CHANGE_PASSWORD_SUCCESS' => 'Password changed successfully',
        'CHANGE_PASSWORD_FAILED' => 'Change password failed, try again!',

        'CONTACT_US_REQUEST_SUCCESS' => 'Contact request sent successfully, thanks',
        'CONTACT_US_REQUEST_FAILED' => 'Failed to send contact request, try again',

        'USER_UPDATED_SUCCESS' => 'Profile updated successfully',
        'USER_UPDATED_FAILED' => 'Profile update failed!, try again',

        'PASSWORD_SENT' => 'Password sent successfully, use it to login to your account',
        'PASSWORD_SEND_FAILED' => 'Failed to sent password, please try again',
        'PASSWORD_ALREADY_SET' => 'Password has been set before!',
        "PASSWORD_NOT_SET" => 'Please request your account password!',
        'CURRENT_PASSWORD_ERROR' => 'The current password does not match',

        'MULTI_ACCESS_ERROR' => 'It is not possible to log in to the same account from two devices at once!',
        'SECURITY_CHECK_SUCCESS' => 'Your status has been sent successfully, keep safe',
        'SECURITY_CHECK_DUPLICATE' => 'Your status has been sent before, keep safe',
        'SECURITY_CHECK_FAILED' => 'There was a malfunction in submitting your case, please try again',

        'CREATE_SUCCESS' => 'Created successfully',
        'CREATE_FAILED' => 'Create failed, please try again',

        'DELETE_SUCCESS' => 'Deleted successfully',
        'DELETE_FAILED' => 'Delete failed, please try again',

        'UPDATE_SUCCESS' => 'Updated successfully',
        'UPDATE_FAILED' => 'Delete failed, please try again',

        'NO_ACCESS_PERMISSION' => 'You dont have access permission to this component',
        'UN_AUTHORIZED_ACTION' => 'You are not authorized to perform this action',
        'NOT_FOUND' => 'Object not fount',

        'FAVORITE_ADD' => 'Product has been added to your favorites successfully',
        'FAVORITE_REMOVED' => 'Product has been removed from your favorites successfully',
        'FAVORITE_FAILED' => 'Favorite process failed, try again',

        'RATE_ADD' => 'Product has been rated successfully',
        'RATE_UPDATED' => 'Product rate has been updated successfully',
        'RATE_FAILED' => 'Product rating failed, try again',

        'ORDER_CREATED' => 'Your request has been sent successfully, and you will be notified in every renewal in its own status',
        'ORDER_FAILED' => 'There was an error creating the request, try again',

        'MOBILE_USED' => 'The phone is already in use',
        'EMAIL_USED' => 'The email is already in use',
        'ERROR_BOOKING' => 'An error occurred while booking, make sure that the data and photos are correct',
        'SUCCESS_ORDER' => 'The request has been sent successfully',
        'ERROR_ORDER' => 'The request has been sent error',
        'CART_IS_EMPTY' => 'Your cart is empty, there are no reservations',
        'ERROR_ORDER_DATE' => 'An error occurred while sending the request. Make sure that the data is correct',
        'NO_ACCESS_ADDRESS' => 'The specified address is not yours',
        'ERROR_COPIS_PHOTO' => 'Be sure to include information on the photo number and copies',
        'ERROR_QUANTITY' => 'Make sure to enter a value in the quantity of images',
        'ERROR_MAX_PHOTO_NUM' => 'The number of selected images, more than the selected packages',
        'SET_DEFUALT_ADDRESS' => 'You must have at least one primary address',
        'ACCEPT_FAILED' => 'An error occurred while accepting the request',
        'ACCEPT_SUCCESS' => 'The request has been successfully accepted',
        'ERROR_LOAD_CART' => 'An error occurred during the download',
        'PROMO_EXPIRED' => 'The discount code is not valid',
        'INVALID_ACTION' => 'Invalid Action',
        "SHOULD_CONFIRM_ORDER" => "The order must be completed first",
        'DELETED_AFTER_24_H' => 'The account will be deleted after 24 hours if there are no requests for you',
        'ALREAY_DELETE_REQUEST' => 'An application is already submitted',
        'ACCOUNT_DELETED' => 'Account is Deleted',
        'LIMIT_USE_PROMO' => 'The cart is below the amount required to use the cart',
        'CHECK_DATA_PATMENT' => "Please check the accuracy of the payment information",
        'ERROR_SAVE_PAYMENT_DATA' => 'An error occurred while saving payment information',
        'ERROR_CONNENCTION_IN_PAYMENT_GETWAY' => 'There was a problem connecting to the payment gateway',
        "THIS_ORDER_IS_PAYED" => "The request has been paid"


    ];

    public static function getMessage($code)
    {
        return request()->header('lang')
            == 'en' ? self::$enMessages[$code] : self::$arMessages[$code];
    }
    
}
