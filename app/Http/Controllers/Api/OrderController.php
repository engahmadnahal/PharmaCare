<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Helpers\ConvertToMeters;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\MastercardController;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\Order\DateReciptResource;
use App\Http\Resources\Order\GeneralResource;
use App\Http\Resources\Order\OrderDetailsResource;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderStatusResource;
use App\Http\Resources\ServiceOnCartResource;
use App\Http\Resources\StudioConfirmResource;
use App\Models\Admin;
use App\Models\AnswerGeneralOrder;
use App\Models\FrameAlbumBooking;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\PassportBooking;
use App\Models\PostcardBooking;
use App\Models\PosterBooking;
use App\Models\ProductBooking;
use App\Models\PromoCode;
use App\Models\PromoCodeUser;
use App\Models\QsDateOrder;
use App\Models\QsGeneralOrder;
use App\Models\Setting;
use App\Models\SoftcopyBooking;
use App\Models\SoftcopyConfirm;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Models\UserAddress;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function sendConfirmd(Request $request)
    {
        $result = [];
        $ans = explode(',', $request->qs_general_answer);
        $ids = explode(',', $request->qs_general_ids);
        foreach ($ids as $k => $id) {
            if ($id == "") {
                continue;
            }
            $result[] = [
                'id' => $id,
                'answer' => $ans[$k]
            ];
        }
        $request->merge([
            'qs_general_ids' => $result
        ]);

        $validator = Validator($request->all(), [
            'payment_way' => 'required|string|in:app,on_receipt',
            'receiving' => 'required|string|in:delivery,print_center',
            'user_address_id' => 'nullable|numeric|exists:user_addresses,id',
            'studio_id' => 'nullable|numeric|exists:studio_branches,id',
            'qs_date_order_id' => 'required|numeric|exists:qs_date_orders,id',
            'qs_general_ids.*.id' => 'required|integer|exists:qs_general_orders,id',
            'qs_general_ids.*.answer' => 'required|string|in:yes,no',
            'username' => 'required|string',
            'usermobile' => 'required|string',
            'promo_code' => 'nullable|string|exists:promo_codes,code'
        ]);

        if (!$validator->fails()) {
            try {


                if (is_null(auth()->user()->cart)) {
                    return response()->json(new ErrorResponse('CART_IS_EMPTY'), Response::HTTP_BAD_REQUEST);
                }

                if (!is_null($request->user_address_id) && !$this->checkAddressUser($request)) {
                    return response()->json(new ErrorResponse('NO_ACCESS_ADDRESS'), Response::HTTP_BAD_REQUEST);
                }

                if (!is_null($request->promo_code) && !$this->checkPromo($request->promo_code)) {
                    return response()->json(new ErrorResponse('PROMO_EXPIRED'), Response::HTTP_BAD_REQUEST);
                }

                $order = $this->createOrder($request);
                if (!$order) {
                    return response()->json(new ErrorResponse('ERROR_ORDER'), Response::HTTP_BAD_REQUEST);
                }

                // هنا تكون مرحلة الدفع والترحيل لـاستوديو
                $isSend = $this->sendToStudio($request, $order);
                if (!$isSend) {
                    return response()->json(new ErrorResponse('ERROR_ORDER'));
                }

                if ($request->payment_way == 'app') {

                    $dataPayment = MastercardController::setUser(auth()->user())
                        ->setAmount($order->cost)
                        ->setOrder($order)
                        ->setCurrencyCode(auth()->user()->currencyCode)
                        ->setOrderId($order->order_num)
                        ->setSoftcopyBooking(null)
                        ->pay();

                    return response()->json(new SuccessResponse('SUCCESS_ORDER', $dataPayment, $request->payment_way == 'app'));
                }

                $this->deleteCart();
                return response()->json(new SuccessResponse('SUCCESS_ORDER', null, false));
            } catch (Exception $e) {
                $order->delete();
                return ControllersService::generateValidationErrorMessage($e->getMessage());
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    private function sendToStudio($request, $order): bool
    {
        $isSuccess = DB::transaction(function () use ($request, $order) {
            $isSuccess = false;
            if ($request->input('receiving') == "delivery") {
                $isSend = $this->selectStudio($request, $order);
                $isSuccess = $isSend;
            } else {
                $order->studio_branch_id = $request->studio_id;
                $order->isSendToStduio = true;
                $saved = $order->save();
                if ($saved) {
                    $std = StudioBranch::find($order->studio_branch_id);
                    if (!is_null($std)) {
                        Notification::sendNow(
                            $std,
                            new NewOrderNotification([
                                'type' => 'order',
                                'title' => 'new_order',
                                'body' => 'new_order_body',
                                'total' => $order->cost,
                                'order_id' => $order->id
                            ])
                        );
                    }
                }

                $isSuccess = $saved;
            }

            if ($isSuccess) {
                $this->anwserQs($order, $request);
                $this->setCartToOrderService($order);
            }

            return $isSuccess;
        });
        return $isSuccess;
    }

    private function checkAddressUser($request)
    {
        $userAddress = UserAddress::find($request->user_address_id);
        if ($userAddress->user_id == auth()->user()->id) {
            return true;
        }
        return false;
    }

    /// Start Order Fn
    private function createOrder($request)
    {


        $cartTotal = (new MyCartController)->getTotal();

        $order = new Order();

        if (!is_null($request->input('user_address_id'))) {
            $userAddress = UserAddress::find($request->input('user_address_id'));
            $order->latitude = $userAddress->latitude;
            $order->longitude = $userAddress->longitude;
        }


        $order->isSendToStduio = false;
        $order->order_status_id = 1;
        $order->order_num = 'OU' . auth()->user()->id . '-' . Carbon::now()->format('Ymd') . '-' . Str::upper(Str::random(3));
        $order->user_id = auth()->user()->id;
        $order->payment_way = $request->input('payment_way');
        $order->receiving = $request->input('receiving');
        $order->user_address_id = $request->input('user_address_id');
        $order->qs_date_order_id = $request->input('qs_date_order_id');

        // Calc Prices
        $order->cost = $this->getCostOrder();
        $order->subtotal = $this->subTotalOrder();
        $order->discount = $this->discountOrder();
        $order->tax = $this->taxOrder();
        $order->total = $cartTotal;
        // Calc Prices

        $order->currency_id = auth()->user()->currency;
        $order->username = $request->username;
        $order->usermobile = $request->usermobile;
        if (!is_null($request->promo_code)) {
            $order->promo_code = $request->promo_code;
            $order->promo_value_discount = $this->promoDisValue();
        }
        if ($request->receiving == 'delivery') {
            $order->delivery = auth()->user()->deliveryPrice;
        } else {
            $order->delivery = 0;
        }
        $order->save();
        return $order;
    }


    private function promoDisValue()
    {
        $request = request();
        $promoDiscount = 0;
        if (!is_null($request->promo_code)) {
            $promo = PromoCode::where('code', $request->promo_code)->first();
            $this->usePromo($promo);
            if ($promo->type != 'fixed') {
                $promoValue = ($promo->value / 100);
                $promoDiscount = $this->subTotalOrder() * $promoValue;
            } else {
                $promoDiscount = $promo->value;
            }
        }
        return $promoDiscount;
    }


    private function taxOrder()
    {
        // $orderTax = 0;
        $orderTax = ($this->subTotalOrder() - $this->discountOrder()) * $this->defualtTaxValue();
        // $orderTax = $this->taxQs() + $subTotalOrderTax;
        return $orderTax;
    }


    // Total Order Not Cart
    private function getCostOrder()
    {
        // Finsh
        $request = request();
        $totalOrder = $this->subTotalOrder() - $this->discountOrder();
        $totalOrder += $this->taxOrder();
        if ($request->receiving == 'delivery') {
            $totalOrder += auth()->user()->deliveryPrice;
        }
        return $totalOrder;
    }

    private function discountOrder()
    {
        $discount = (new MyCartController)->getDiscount();
        $discount += $this->promoDisValue();
        return $discount;
    }

    // SubTotal Order Not Cart
    private function subTotalOrder()
    {
        // Finsh
        $request = request();
        $subTotalCart = (new MyCartController)->getSubTotal();
        $subTotal = $subTotalCart;
        $subTotal += $this->getTotalGeneralQs($request);
        $subTotal += $this->getTotalDateQs($request);
        return $subTotal;
    }

    private function getTotalGeneralQs($request)
    {
        // Finsh
        $total = 0;
        foreach ($request->input('qs_general_ids') as $qsGeneral) {
            $qsGeneral = (object) $qsGeneral;
            if ($qsGeneral->answer == 'yes') {
                $qs = QsGeneralOrder::findOrFail($qsGeneral->id);
                $total += $qs->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0;
            }
        }
        return $total;
    }

    private function getTotalDateQs($request)
    {
        // Finsh
        $total = 0;
        $qs = QsDateOrder::findOrFail($request->qs_date_order_id);
        $total += $qs->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0;
        return $total;
    }

    private function selectStudio($request, $order)
    {
        $studios = $this->getCloserStudio($request);

        if ($studios->count() > 0) {


            $order->isSendToStduio = true;
            $order->studio_branch_id = $studios?->first()?->id;
            $saved = $order->save();

            if ($saved) {
                $std = StudioBranch::find($order->studio_branch_id);
                if (!is_null($std)) {
                    Notification::sendNow(
                        $std,
                        new NewOrderNotification([
                            'type' => 'order',
                            'title' => 'new_order',
                            'body' => 'new_order_body',
                            'total' => $order->cost,
                            'order_id' => $order->id
                        ])
                    );
                }
            }
        }

        if ($studios->count() == 0) {

            $order->isSendToStduio = false;
            $saved = $order->save();

            if ($saved) {
                $admins = Admin::all();
                Notification::sendNow(
                    $admins,
                    new NewOrderNotification([
                        'type' => 'order',
                        'title' => 'new_order_no_studio',
                        'body' => 'new_order_no_studio_body',
                        'total' => $order->cost,
                        'order_id' => $order->id
                    ])
                );
            }
        }


        return (bool) $saved;
    }


    private function servicesCart()
    {
        $myCard = (new MyCartController())->getServices();
        $services = collect();
        foreach ($myCard as $item) {
            if (is_null($item->masterService)) continue;
            $services->add([
                'id' => $item->masterService->service_studio_id,
                'booking' => $item
            ]);
        }
        return $services;
    }
    // اقرب ستوديو
    private function getCloserStudio($request)
    {
        $qsGeneralLawful = QsGeneralOrder::first(); // اول سؤال في هذا الجدول ، دائما وابدا لسؤال هل تريد تصوي شرعي ويتم مقارنتها مع اذا كان الاستوديو يقدم هذه الخدمة ام لا
        $userIsSelectLawful = false; // check user used lawfulQs or Not
        foreach ($request->input('qs_general_ids') as $qsGeneral) {
            $qsGeneral = (object) $qsGeneral;
            if ($qsGeneral->answer == 'yes') {
                if ($qsGeneral->id == $qsGeneralLawful->id) {
                    $userIsSelectLawful = true;
                }
            }
        }


        $myCard = (new MyCartController())->getServices();
        $servicesIds = collect();
        foreach ($myCard as $item) {
            if (is_null($item->masterService)) continue;
            $servicesIds->add([
                'id' => $item->masterService->service_studio_id,
                'booking' => $item
            ]);
        }

        // Al studio take services in user cart
        $studios = collect();
        $addressUser = UserAddress::find($request->user_address_id);
        $productIds = $this->getProductBookingIds();
        $stdCityUser = StudioBranch::where('block', false)
            ->where('active', true)
            ->where('isAcceptable', 'accept')
            ->where('city_id', $addressUser->city_id)
            ->whereHas('services', function ($q) use ($servicesIds) {
                $q->whereIn('service_studio_id', $servicesIds->pluck('id'));
            })
            ->when($this->cartExistsProduct(), function ($q) use ($productIds) {
                $q->whereHas('products', function ($q) use ($productIds) {
                    $q->whereIn('products.id', $productIds);
                });
            })
            ->when($userIsSelectLawful, function ($q) {
                $q->where('is_lawful_service', true);
            })
            ->get();

        $userLat = (float) $addressUser->latitude;
        $userLong = (float) $addressUser->longitude;

        foreach ($stdCityUser as $std) {
            $stdLat = (float) $std->latidute;
            $stdLong = (float) $std->longitude;

            $distance = ConvertToMeters::calc($userLat, $userLong, $stdLat, $stdLong);
            $distance_sort = ConvertToMeters::pureCalc($userLat, $userLong, $stdLat, $stdLong);
            $std->setAttribute('distance', $distance);
            $std->setAttribute('distance_sort', $distance_sort);
            $studios->add($std);
        }

        return $studios->sortBy('distance_sort');
    }


    private function getProductBookingIds()
    {
        $data = collect();
        $cart = MyCart::where('user_id', auth()->user()->id)->where('object_type', ProductBooking::class)->get();
        foreach ($cart as $prd) {
            $booking = ProductBooking::find($prd->object_id);
            if (is_null($booking)) continue;
            $data->add([
                'id' => $booking->product_id
            ]);
        }
        return $data->pluck('id');
    }

    private function cartExistsProduct()
    {
        return MyCart::where('user_id', auth()->user()->id)->where('object_type', ProductBooking::class)->exists();
    }


    private function defualtTaxValue()
    {
        $defualtTax = Setting::first();
        if ($defualtTax->is_tax) {
            return $defualtTax->tax / 100;
        }
        return 0;
    }

    /// End Order Fn
    public function getConfirm()
    {
        $data = [
            'total_ditals' => $this->totalDetails(),
            'setting' => ['tax' => $this->defualtTaxValue()],
            'qs_date_of_receipt' => DateReciptResource::collection(QsDateOrder::all()),
            'qs_general' => GeneralResource::collection(QsGeneralOrder::all()),
            // 'services' => (new MyCartController())->getServices(),
        ];
        return response()->json(new SuccessResponse('SUCCESS_GET', $data));
    }

    public function getOrders()
    {
        $data = Order::where('user_id', auth()->user()->id) 
        ->where(function($q){
            $q->where(function($q){
                $q->where('paid_status',true)
                    ->orWhere('payment_way','on_receipt');
            })->orWhere('isSoftCopy',true);
        })
        ->orderBy('id', 'desc')->get();
        
        return response()->json(new SuccessResponse('SUCCESS_GET', OrderResource::collection($data)));
    }

    public function getStatusOrder()
    {
        $data = OrderStatus::where('active', true)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET', OrderStatusResource::collection($data)));
    }

    public function getOrderByStatus(OrderStatus $orderStatus)
    {
        $data = Order::where('user_id', auth()->user()->id)->where('order_status_id', $orderStatus->id)
        ->where(function($q){
            $q->where(function($q){
                $q->where('paid_status',true)
                    ->orWhere('payment_way','on_receipt');
            })->orWhere('isSoftCopy',true);
        })->orderBy('id', 'desc')->get();
        return response()->json(new SuccessResponse('SUCCESS_GET', OrderResource::collection($data)));
    }

    public function orderDeatials(Order $order)
    {
        if ($order->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NO_ACCESS_PERMISSION'), Response::HTTP_BAD_REQUEST);
        }
        $arrData = collect();
        $data = OrderService::where('order_id', $order->id)->get();
        foreach ($data as $d) {
            $object = $this->getObjectMorph($d->object_type, $d->object_id);
            if ($object == null) continue;
            $object->setAttribute('type_object', $d->object_type);
            $object->setAttribute('totalService', $d->price);
            $object->setAttribute('isRate', !is_null($d->rate));
            $object->setAttribute('rate', $d->rate ?? 0);
            $arrData->add($object);
        }
        $order->setAttribute('services', ServiceOnCartResource::collection($arrData));
        return response()->json(new SuccessResponse('SUCCESS_GET', new OrderDetailsResource($order)));
    }

    // Functions
    private function totalDetails()
    {
        return  [
            'cuerrncy' => auth()->user()->currencyCode,
            'tax' => (float) number_format((new MyCartController())->getTax(), 2),
            'subtotal' => (float) number_format((new MyCartController())->getSubTotal(), 2),
            'discounts' => (float)  number_format((new MyCartController())->getDiscount(), 2),
            'delivery' => (float) auth()->user()->deliveryPrice,
            'total' => (float) number_format((new MyCartController())->getTotal(), 2)
        ];
    }

    private function anwserQs(Order $order, $request)
    {
        foreach ($request->input('qs_general_ids') as $qsGeneral) {
            $qsGeneral = (object) $qsGeneral;
            $answerOrder = new AnswerGeneralOrder();
            $answerOrder->qs_general_order_id = $qsGeneral->id;
            $answerOrder->order_id = $order->id;
            $answerOrder->user_id = auth()->user()->id;
            $answerOrder->answer = $qsGeneral->answer;
            $answerOrder->save();
        }
    }

    private function setCartToOrderService($order)
    {
        $cart = MyCart::where('user_id', auth()->user()->id);
        
        foreach ($cart->get() as $item) {
            $orderService = new OrderService();
            $orderService->order_id = $order->id;
            $orderService->object_type = $item->object_type;
            $orderService->object_id = $item->object_id;
            $orderService->price = $this->priceService($item);
            $orderService->save();
        }
    }


    private function priceService($item)
    {

        switch ($item->object_type) {
            case PosterBooking::class:
                return (new MyCartController())->getTotalPosterBooking($item->object);
                break;

            case PostcardBooking::class:
                return (new MyCartController())->getTotalPostcardBooking($item->object);
                break;

            case FrameAlbumBooking::class:
                return (new MyCartController())->getTotalFrameBooking($item->object);
                break;

            case PassportBooking::class:
                return (new MyCartController())->getTotalPassportBooking($item->object);
                break;

            case SoftcopyBooking::class:
                return 0;
                break;
            case StudioBooking::class:
                return (new MyCartController())->getTotalStudioBooking($item->object);
                break;
        }
    }


    private function deleteCart()
    {
        MyCart::where('user_id', auth()->user()->id)->delete();
    }


    private function getObjectMorph($obj, $id)
    {
        switch ($obj) {
            case PosterBooking::class:
            case "poster":
                return PosterBooking::find($id);
                break;

            case PostcardBooking::class:
            case "postcard":
                return PostcardBooking::find($id);
                break;

            case FrameAlbumBooking::class:
            case "frameOrAlbum":
                return FrameAlbumBooking::find($id);
                break;

            case PassportBooking::class:
            case "passport":
                return PassportBooking::find($id);
                break;

            case SoftcopyBooking::class:
                return SoftcopyBooking::find($id);
                break;

            case StudioBooking::class:
                return StudioBooking::find($id);
                break;
        }
    }


    public function getStudios(Request $request)
    {
        $validator = Validator($request->all(), [
            'lat' => 'required|string',
            'long' => 'required|string',
        ]);

        if (!$validator->fails()) {
            $servicesIds = $this->servicesCart();
            $data = collect();
            $allStudios = StudioBranch::where('block', false)
                ->where('active', true)
                ->has('services')
                ->where('isAcceptable', 'accept')
                ->where('city_id', auth()->user()->defaultAddress?->city_id)
                ->orderBy('orderd')
                ->whereHas('services', function ($q) use ($servicesIds) {
                    $q->whereIn('service_studio_id', $servicesIds->pluck('id'));
                })
                ->take(4)
                ->get();

            if ($allStudios->count() == 0) {
                $allStudios = StudioBranch::where('block', false)
                    ->where('active', true)
                    ->where('isAcceptable', 'accept')
                    ->where('city_id', auth()->user()->defaultAddress?->city_id)
                    ->orderBy('orderd')
                    ->take(4)
                    ->get();
            }
            foreach ($allStudios as $studio) {
                $stdLat = $studio->latidute;
                $stdLong = $studio->longitude;
                $distance = ConvertToMeters::convert($request->lat, $request->long, $stdLat, $stdLong);
                $distanceSort = ConvertToMeters::pureCalc($request->lat, $request->long, $stdLat, $stdLong);
                $studio->setAttribute('distance_sort', $distanceSort);
                $studio->setAttribute('distance', $distance);
                $data->add($studio);
            }

            $sortData = $data->sortBy(function ($d) {
                return $d->distance_sort;
            });
            return response()->json(new SuccessResponse('SUCCESS_GET', StudioConfirmResource::collection($sortData)), Response::HTTP_OK);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }




    private function usePromo($promo)
    {
        $use = new PromoCodeUser();
        $use->user_id = auth()->user()->id;
        $use->promo_code_id = $promo->id;
        $use->save();
    }
    private function checkPromo($promo_code)
    {
        $promo = PromoCode::where('code', $promo_code)->first();
        $subTotal = (new MyCartController())->getSubTotal();
        if (
            Carbon::parse($promo->end)->lt(Carbon::now()) ||
            Carbon::parse($promo->start)->gt(Carbon::now()) ||
            $promo->currentBeneficiaries >= $promo->max_usege ||
            $promo->priceKey > $subTotal
        ) return false;

        return true;
    }
    public function dataPromoCode(Request $request)
    {
        $validator = Validator($request->all(), [
            'promo_code' => 'required|string|exists:promo_codes,code'
        ]);

        if (!$validator->fails()) {
            $promo = PromoCode::where('code', $request->promo_code)->first();
            if (
                Carbon::parse($promo->end)->lt(Carbon::now()) ||
                Carbon::parse($promo->start)->gt(Carbon::now()) ||
                $promo->currentBeneficiaries >= $promo->max_usege
            ) {
                return response()->json(new ErrorResponse('PROMO_EXPIRED'), Response::HTTP_BAD_REQUEST);
            }

            $subTotal = (new MyCartController())->getSubTotal();
            if ($promo->priceKey > $subTotal) {
                return response()->json(new ErrorResponse('LIMIT_USE_PROMO'), Response::HTTP_BAD_REQUEST);
            }

            return response()->json(new SuccessResponse('SUCCESS_GET', [
                'type' => $promo->type,
                'value' => $promo->valueKey,
                'code' => $promo->code,
                'min_price' => $promo->priceKey,
            ]));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    private function taxSoft($soft,$price){
        $tax = $soft->softcopy->tax;
        $isTax = $soft->softcopy->is_tax;
        if($isTax){
            return $price * ($tax / 100);
        }
        return 0;
    }

    public function confirmSoftcopy(Request $request)
    {
        $validator = Validator($request->all(), [
            'username' => 'required|string',
            'usermobile' => 'required|string',
            'softcopy_booking_id' => 'required|integer|exists:softcopy_bookings,id'
        ]);

        if (!$validator->fails()) {
            $soft = SoftcopyBooking::find($request->softcopy_booking_id);

            if (SoftcopyConfirm::where('softcopy_booking_id', $request->softcopy_booking_id)->exists()) {
                return response()->json(new ErrorResponse('INVALID_ACTION'));
            }

            try {

                $tax = $this->taxSoft($soft,$soft->price);
                $order = Order::where('user_id',auth()->user()->id)->where('softcopy_booking_id',$soft->id)->first();
                $dataPayment = MastercardController::setUser(auth()->user())
                    ->setAmount($soft->price + $tax)
                    ->setOrder($order)
                    ->setCurrencyCode(auth()->user()->currencyCode)
                    ->isSoftCopy(true)
                    ->setUserName($request->username)
                    ->setMobile($request->usermobile)
                    ->isSoftCopy(true)
                    ->setOrderId('SOFTCOPY-' . $soft->id)
                    ->setSoftcopyBooking($soft)
                    ->pay();

                return response()->json(new SuccessResponse('SUCCESS_PAY', $dataPayment));
            } catch (Exception $e) {

                return ControllersService::generateValidationErrorMessage($e->getMessage());
            }
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
