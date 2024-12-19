<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SuccessResponse;
use App\Models\Admin;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\SoftcopyBooking;
use App\Models\SoftcopyConfirm;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\PaidOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MastercardController extends Controller implements IPayment
{
    private const API_KEY = "050ccb036307426a6a4ace4a57a70ad2";
    private const BASE_URL = "https://test-network.mtf.gateway.mastercard.com/api/nvp/version/73";
    private const API_USER = 'TESTNITEST2';
    private const MERCHANT = 'TESTNITEST2';

    public static User $user;
    private static $amount;
    private static $currency;
    private static $orderId;
    private static ?Order $order;
    private static $redirectUrl;
    private static $transactionId;
    private static $isSoftCopy;
    private static ?SoftcopyBooking $softcopyBooking;
    private static $userName = null;
    private static $mobile = null;



    public function setMobile($mobile): IPayment
    {
        static::$mobile = $mobile;
        return $this;
    }


    public function setUserName($userName): IPayment
    {

        static::$userName = $userName;
        return $this;
    }


    public function setSoftcopyBooking(?SoftcopyBooking $softcopyBooking): IPayment
    {

        static::$softcopyBooking = $softcopyBooking;
        return $this;
    }

    public static function isSoftCopy($isSoftCopy): IPayment
    {

        static::$isSoftCopy = $isSoftCopy;
        return new static;
    }

    public function setOrder(?Order $order): IPayment
    {

        static::$order = $order;
        return $this;
    } // Your Transaction Id Or Order Id , This Same For unique transactions

    public function setOrderId($orderId): IPayment
    {
        static::$orderId = $orderId;
        return $this;
    } // Your Transaction Id Or Order Id , This Same For unique transactions


    public static function setUser(User $user): IPayment
    {
        static::$user = $user;
        return new static;
    } // Amount Before Transaction



    public function setAmount($amount): IPayment
    {
        static::$amount = $amount;
        return $this;
    } // Amount Before Transaction


    public function setCurrencyCode($currency): IPayment
    {
        static::$currency = $currency;
        return $this;
    } // Select Currency Code

    public function getOrderId()
    {
        return static::$orderId; // For Test
    } // Transaction Id In Payment Get Way 


    public function getRedirectUrl()
    {
        return static::$redirectUrl;
    }

    private function checkRequiredInstance()
    {

        if (is_null(self::$orderId) && !self::$isSoftCopy) {
            throw new Exception('Order Id Is Required When Order Type not Softcopy');
        }

        if (is_null(self::$softcopyBooking) && self::$isSoftCopy) {
            throw new Exception('Softcopy Booking Is Required When Order type softcopy');
        }


        if (is_null(self::$userName) && self::$isSoftCopy) {
            throw new Exception('User Name Is Required When Order type softcopy');
        }

        if (is_null(self::$mobile) && self::$isSoftCopy) {
            throw new Exception('Mobile Is Required When Order type softcopy');
        }

        if (is_null(self::$amount)) {
            throw new Exception('Amount Is Required');
        }

        if (is_null(self::$currency)) {
            throw new Exception('Currency Is Required');
        }

        if (is_null(self::$user)) {
            throw new Exception('User Is Required');
        }
    }

    public function pay()
    {

        $this->checkRequiredInstance();

        $bodyRequest = [
            'apiOperation' => 'INITIATE_CHECKOUT',
            'apiPassword' => self::API_KEY,
            'apiUsername' => 'merchant.' . self::API_USER,
            'merchant' => self::MERCHANT,
            'interaction.operation' => 'AUTHORIZE',
            'interaction.merchant.name' =>  'Photome System',
            'interaction.returnUrl' => route('mastercard.returnUrl', [
                'userId' => static::$user->id,
                'orderId' => static::$order?->id,
                'amount' => static::$amount,
                'isSoftCopy' => static::$isSoftCopy,
                'softcopy_id' => static::$softcopyBooking?->id ?? 0,
                'userName' => static::$userName,
                'mobile' => static::$mobile,
            ]),
            'order.id' => static::$orderId,
            'order.amount' => static::$amount,
            'order.currency' => static::$currency,
            'order.description' => static::$user->name . ' ' . static::$user->email,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::BASE_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bodyRequest));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('CHECK_DATA_PATMENT');
        }

        curl_close($ch);

        if ($response) {

            $responseData = explode('&', $response);
            $sessionId = explode('=', $responseData[3])[1];


            if ($sessionId == 'INVALID') {
                $reasonInvalid = explode('=', $responseData[2])[1];
                if ($reasonInvalid == 'order.currency') {
                    throw new Exception('Invalid Currency , Must 3 char');
                }
                throw new Exception($reasonInvalid);
            }

            self::$transactionId = $sessionId;
            self::$redirectUrl = "https://test-network.mtf.gateway.mastercard.com/checkout/pay/$sessionId?checkoutVersion=1.0.0";

            return [
                'redirect_url' => self::$redirectUrl
            ];
        } else {
            return ControllersService::generateValidationErrorMessage(Messages::getMessage('ERROR'));
        }
    }

    public function getAmount()
    {
        return self::$amount;
    } // Get Amount On Payment Get Way

    public function getCurrencyCode()
    {
        return self::$currency;
    } // Get Currency Code On Payment Get Way


    public function getTransaction()
    {
        return self::$transactionId;
    }


    private function paymentOrder(Request $request)
    {

        $paymentOrder = new PaymentOrder();
        $paymentOrder->amount = $request->amount;
        $paymentOrder->user_id = $request->userId;
        $paymentOrder->order_id = $request->orderId;
        $paymentOrder->resultIndicator = $request->resultIndicator;
        $paymentOrder->sessionVersion = $request->sessionVersion;
        $paymentOrder->checkoutVersion = $request->checkoutVersion;
        $paymentOrder->status = 'success';
        $saved = $paymentOrder->save();

        if ($saved) {
            $updated = Order::whereId($request->orderId)->update(['paid_status' => true]);
            MyCart::where('user_id', $request->userId)->delete();

            if ($updated) {

                $order = Order::find($request->orderId);

                $admin = Admin::first();
                Notification::sendNow(
                    $admin,
                    new PaidOrderNotification([
                        'type' => 'order',
                        'title' => 'pay_order',
                        'body' => 'pay_order_details',
                        'total' => $order->cost,
                        'order_id' => $order->id
                    ])
                );
                
            }


        }

        if (!$saved) {
            throw new Exception(Messages::getMessage('ERROR_SAVE_PAYMENT_DATA'));
        }

        return $this->getRedirectUrl();
    }


    private function storeSoftCopyConfirm(Request $request)
    {

        $soft = SoftcopyBooking::find($request->softcopy_id);

        $tax = $soft->is_tax ? $soft->price * ($soft->tax / 100) : 0;
        $softConfirtm = new SoftcopyConfirm();
        $softConfirtm->user_name = $request->userName;
        $softConfirtm->user_mobile = $request->mobile;
        $softConfirtm->softcopy_booking_id = $soft->id;
        $softConfirtm->total_booking = $soft->price + $tax;
        $softConfirtm->total_recive = $soft->price + $tax;
        $saved = $softConfirtm->save();

        if ($saved) {
            $updated = Order::whereId($request->orderId)->update(['paid_status' => true]);
            if ($updated) {

                $order = Order::find($request->orderId);

                $admin = Admin::first();
                Notification::sendNow(
                    $admin,
                    new PaidOrderNotification([
                        'type' => 'order',
                        'title' => 'pay_order',
                        'body' => 'pay_order_details',
                        'total' => $order->cost,
                        'order_id' => $order->id
                    ])
                );

            }
        }

        return $saved;
    }



    public function handlePayment(Request $request)
    {

        if ($request->isSoftCopy) {
            $saved = $this->storeSoftCopyConfirm($request);
        } else {
            $saved = $this->paymentOrder($request);
        }

        if ($saved) {
            $deepLink = "photome://photome.com?status=success&message=SUCCESS_PAY_ORDER";
            return redirect()->away($deepLink);
        }
        $deepLink = "photome://photome.com?status=error&message=ERROR_SAVE_PAYMENT_ORDER";
        return redirect()->away($deepLink);
    }
}
