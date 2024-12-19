<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Helpers\ConvertToMeters;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\MastercardController;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\StudioResource;
use App\Http\Resources\StudioServicesResource;
use App\Models\BookingStudioService;
use App\Models\MyCart;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\PaymentOrder;
use App\Models\ServicesBookingStudio;
use App\Models\Studio;
use Illuminate\Support\Str;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;
use Symfony\Component\HttpFoundation\Response;

class StudioController extends Controller
{
    public function allServicesStudio(){
        $data = ServicesBookingStudio::with('price')->get();
        return response()->json(new SuccessResponse('SUCCESS_GET',StudioServicesResource::collection($data)),Response::HTTP_OK);
    }

    public function allStudio(BookingStudioService $bookingStudioService,$lat,$long){
        $data = StudioBranch::where('block',false)  
        ->where('active',true)
        ->has('bookginServicesStudio')
        ->where('city_id',auth()->user()->defaultAddress?->city_id)
        ->where('isAcceptable','accept')->get();
        
        foreach($data as $std){
            $std->setAttribute('user_latidute',$lat);
            $std->setAttribute('user_longitude',$long);
            $std->setAttribute('taxValue',$bookingStudioService->is_tax ? $bookingStudioService->tax / 100 : 0);
        }

        foreach($data as $std){
            $latUser = $std->user_latidute;
            $longUser = $std->user_longitude;
            $distance  = ConvertToMeters::convert($latUser,$longUser,$std->latidute,$std->longitude);
            $distanceSort = ConvertToMeters::pureCalc($latUser,$longUser,$std->latidute,$std->longitude);
            $std->setAttribute('distance_sort', $distanceSort);
            $std->setAttribute('distance',$distance);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET',StudioResource::collection( $data->sortBy('distance_sort'))),Response::HTTP_OK);
    }

    public function singleStudio(BookingStudioService $bookingStudioService,StudioBranch $studioBranch,$lat,$lang){
        $studioBranch->setAttribute('user_latidute',$lat);
        $studioBranch->setAttribute('user_longitude',$lang);
        $studioBranch->setAttribute('taxValue',$bookingStudioService->is_tax ? $bookingStudioService->tax / 100 : 0);
        return response()->json(new SuccessResponse('SUCCESS_GET',new StudioResource($studioBranch)),Response::HTTP_OK);
    }
    
    public function studioByService(BookingStudioService $bookingStudioService,$id,$lat,$long){
        $data = StudioBranch::where('block',false)  
        ->where('active',true)
        ->where('city_id',auth()->user()->defaultAddress?->city_id)
        ->where('isAcceptable',true)->whereHas('bookginServicesStudio', function($q) use($id){
            $q->where('services_id',$id);
        })->where('isAcceptable','accept')->where('active',true)->get();

        foreach($data as $std){
            $std->setAttribute('user_latidute',$lat);
            $std->setAttribute('user_longitude',$long);
            $std->setAttribute('taxValue',$bookingStudioService->is_tax ? $bookingStudioService->tax / 100 : 0);
            $stdLat = $std->latidute;
            $stdLong = $std->longitude;
            $distance = ConvertToMeters::convert($lat, $long,$stdLat, $stdLong);
            $std->setAttribute('distance', $distance);
            
        }
        return response()->json(new SuccessResponse('SUCCESS_GET',StudioResource::collection($data)),Response::HTTP_OK);
    }

    public function setBooking(Request $request){
        $validator = Validator($request->all(),[
            'studio_id' => 'required|numeric|exists:studio_branches,id',
            'service_studio_id' => 'required|numeric|exists:services_booking_studios,id',
            'date' => 'required|date_format:Y/n/j',
            'time_from' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'quantity' => 'required|integer',
            'people_num' => 'required|integer',
            'payment_method' => 'required|string|in:app,on_receipt'
        ]);
        if(!$validator->fails()){

            if(!isset(auth()->user()->defaultAddress)){
                return response()->json(new ErrorResponse('MUST_HAS_DEFAULT_ADDRESS'),Response::HTTP_BAD_REQUEST);
            }

           $resp =  DB::transaction(function () use($request){

                $studioBooking = new StudioBooking();
                $studioBooking->user_id = auth()->user()->id;
                $studioBooking->people_num = $request->people_num;
                $studioBooking->studio_id = $request->input('studio_id');
                $studioBooking->services_booking_studio_id = $request->input('service_studio_id');
                $studioBooking->date = Carbon::parse($request->input('date'))->format('Y-m-d');
                $studioBooking->time_from = $request->input('time_from');
                $studioBooking->note = $request->input('note');
                $studioBooking->qty = $request->input('quantity');
                $saved = $studioBooking->save();
                if($saved){

                    $order = $this->createOrder($studioBooking,auth()->user(),$request);

                    if($request->payment_method == 'app'){

                        $dataPayment = MastercardController::setUser(auth()->user())
                        ->setAmount($order->cost)
                        ->setOrder($order)
                        ->setCurrencyCode(auth()->user()->currencyCode)
                        ->setOrderId($order->order_num)
                        ->setSoftcopyBooking(null)
                        ->pay();
    
                        return [
                            'status' => $saved,
                            'data' => $request->payment_method == 'app' ? $dataPayment : '',
                        ];
                        
                    }
                }

                return [
                    'status' => $saved,
                    'data' => null,
                ];
                
            });
           
            if(!$resp['status']){
                return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND',$resp['data'],$request->payment_method == 'app'));
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
        
    }


    public function getEditBooking(BookingStudioService $bookingStudioService,StudioBooking $studioBooking,$lat,$lang){
        $studioBranch = StudioBranch::find($studioBooking->studio->id);
        $studioBranch->setAttribute('user_latidute',$lat);
        $studioBranch->setAttribute('user_longitude',$lang);
        $studioBranch->setAttribute('taxValue',$bookingStudioService->is_tax ? $bookingStudioService->tax / 100 : 0);
        $studioBranch->setAttribute('bookingUser',$studioBooking);
        return response()->json(new SuccessResponse('SUCCESS_GET',new StudioResource($studioBranch)),Response::HTTP_OK);
    }

    public function editBooking(Request $request,StudioBooking $studioBooking){

        $paymentOrder = PaymentOrder::whereHas('order',function($q) use($studioBooking){
            $q->where('studio_booking_id',$studioBooking->id);
        })->exists();
        
        if($paymentOrder){
            return ControllersService::generateValidationErrorMessage(Messages::getMessage('THIS_ORDER_IS_PAYED'));
        }

        $validator = Validator($request->all(),[
            'service_studio_id' => 'required|numeric|exists:services_booking_studios,id',
            'date' => 'required|date_format:Y/n/j',
            'time_from' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'quantity' => 'required|integer',
            'people_num' => 'required|integer',

        ]);
        if(!$validator->fails()){
            try{
                $studioBooking->people_num = $request->input('people_num');
                $studioBooking->services_booking_studio_id = $request->input('service_studio_id');
                $studioBooking->date = Carbon::parse($request->input('date'))->format('Y-m-d');
                $studioBooking->time_from = $request->input('time_from');
                $studioBooking->note = $request->input('note');
                $studioBooking->qty = $request->input('quantity');
                $updated = $studioBooking->save();
                if(!$updated){
                    return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);
                }

                return response()->json(new SuccessResponse('SUCCESS_SEND',null,false));
            }catch(Expectation $e){
                return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);
            }
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
        
    }

    private function createOrder($booking,$user,$request)
    {
        $order = new Order();
        $userAddress = auth()->user()->defaultAddress;
        $order->latitude = $userAddress->latitude;
        $order->longitude = $userAddress->longitude;
        $order->isSoftCopy = false;
        $order->isSendToStduio = false;
        $order->isStudioBooking = true;
        $order->studio_branch_id = $booking->studio_id;
        $order->order_status_id = OrderStatus::first()->id;
        $order->order_num = 'OU' . auth()->user()->id . '-' . Carbon::now()->format('Ymd') . '-STUDIO-'. Str::upper(Str::random(3));
        $order->user_id = $user->id;
        $order->payment_way = $request->payment_method;
        $order->receiving = 'print_center';
        $order->cost = $this->totalBook($booking);
        $order->subtotal = $this->subtotalBook($booking);
        $order->total = $this->totalBook($booking);
        $order->discount = 0;
        $order->delivery = 0;
        $order->tax = $this->taxBook($booking);
        $order->currency_id = $user->currency;
        $order->username = $user->name;
        $order->usermobile = $user->mobile;
        $saved = $order->save();
        if($saved) {
            $this->setService($order,$booking);
        }
        return $order;
    }

    private function setService($order,$booking){
        $orderService = new OrderService();
            $orderService->order_id = $order->id;
            $orderService->object_type = StudioBooking::class;
            $orderService->object_id = $booking->id;
            $orderService->price = $this->getTotalStudioBooking($booking);
            $orderService->save();
    }

    public function getTotalStudioBooking(StudioBooking $data, $getTax = false, $getDiscount = false, $subTotal = false)
    {
        if (!is_null($data)) {
            $service = ServicesBookingStudio::find($data->services_booking_studio_id);
            if (is_null($service)) {
                return 0;
            }
            $basePrice = $service->priceKey  ?? 0;
            $pricePhotoAfterIncrse = $service->priceAfterIncresKey  ?? 0; // مقدار الخصم بعد الزيادة
            $price = ($basePrice * 0.5); // مقدار الزيادة على السعر الاساسي
            $baseCountImage = $service->num_photo; // العدد الاساسي
            $num_add = $service->num_add; // معدل الزيادة
            $quantity = $data->qty; // الكمية المطلوبة
            $incrseCount = (($quantity - $baseCountImage) / $num_add);
            $priceIncrse = $incrseCount * $price;
            $discount = $incrseCount * $pricePhotoAfterIncrse; // الخصم هو قيمه الخصم بعد الزيادة 
            $subtotal = ($basePrice + $priceIncrse) * $data->people_num;

            if ($data->masterService->is_tax && !$subTotal) {
                $tax = ($subtotal - $discount) * ($data->masterService?->tax / 100); // قيمة الضريبة
            } else {
                $tax = 0; // قيمة الضريبة
            }
            $total = ($subtotal - $discount) + $tax;

            if ($getTax) {
                if ($data->masterService->is_tax) {
                    return $tax;
                }
                return 0;
            }

            if ($getDiscount) {
                return $discount;
            }

            $booking = StudioBooking::find($data->id);
            $booking->update([
                'total' => $total,
                'currency_id' => auth('user-api')->user()->currency
            ]);
            return $subTotal ? $total + $discount : $total;
        }
        return 0;
    }

    private function totalBook($booking){
        return $this->getTotalStudioBooking($booking);
    }

    private function subtotalBook($booking){
        return $this->getTotalStudioBooking(data:$booking , subTotal:true);

    }

    private function taxBook($booking){
        return $this->getTotalStudioBooking(data:$booking , getTax:true);

    }

    public function deleteBookgin(StudioBooking $studioBooking){
        $orderDelete = Order::whereHas('services',function($q) use($studioBooking){
            $q->where('object_type',StudioBooking::class)->where('object_id',$studioBooking->id);
        })->delete();
        if($orderDelete){
            $deleted = $studioBooking->delete();
        }

        if(!$deleted && !$orderDelete){
            return response()->json(new ErrorResponse('ERROR_DELETE'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_DELETE',[],false));
    }
}
