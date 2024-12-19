<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\SoftcopyBooking;
use App\Models\SoftCopyService;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SoftCopyController extends Controller
{
    use CustomTrait;
    public function setBooking(Request $request, SoftCopyService $softCopyService)
    {
        $validator = Validator($request->all(), [
            'images'    => 'required|array',
            'images.*'  => 'required|image|mimes:jpg,png,jpeg,gif',
            'receive'   => 'required|string',
            'msg'       => 'required|string',
        ]);
        if (!$validator->fails()) {
            try {
                $softcopybooking = new SoftcopyBooking();
                $softcopybooking->soft_copy_service_id = $softCopyService->id;
                $softcopybooking->user_id = auth()->user()->id;
                $softcopybooking->msg = $request->input('msg');
                $softcopybooking->receive = $request->input('receive');
                $save = $softcopybooking->save();

                if ($save) {
                    $userId = auth()->user()->id;
                    foreach ($request->file('images') as $image) {
                        $softcopybooking->images()->create([
                            'path' => $this->uploadFile($image, "softcopy/user/{$userId}/booking/{$softcopybooking->id}"),
                        ]);
                    }

                    $admins = Admin::all();
                    Notification::sendNow(
                        $admins,
                        new NewOrderNotification([
                            'type' => 'softcopy',
                            'title' => 'new_order_softcopy',
                            'body' => 'new_order_body_softcopy',
                            'total' => '',
                            'order_id' => $softcopybooking->id
                        ])
                    );
                }
            } catch (Exception $e) {
                $softcopybooking->delete();
                return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    private function createOrder($soft)
    {
        $order = new Order();
        $order->softcopy_booking_id = $soft->id;
        $order->isSoftCopy = true;
        $order->isSendToStduio = false;
        $order->isStudioBooking = false;
        $order->order_status_id = 1;
        $order->order_num = 'OU' . auth()->user()->id . '-' . Carbon::now()->format('Ymd') . Str::random(3);
        $order->user_id = auth()->user()->id;
        $order->payment_way = 'app';
        $order->receiving = 'print_center';
        $order->cost = (new MyCartController)->getTotal(true);
        $order->subtotal = (new MyCartController)->getSubTotal(true);
        $order->total = (new MyCartController)->getTotal(true);
        $order->discount = (new MyCartController)->getDiscount(true);
        $order->delivery = 0;
        $order->tax = (new MyCartController)->getTax(true);
        $order->currency_id = auth()->user()->currency;
        $order->username = auth()->user()->name;
        $order->usermobile = auth()->user()->mobile;
        $saved = $order->save();
        if ($saved) {
            $this->setService($order, $soft);
        }
        return $order;
    }

    private function setService($order, $soft)
    {
        $orderService = new OrderService();
        $orderService->order_id = $order->id;
        $orderService->object_type = SoftcopyBooking::class;
        $orderService->object_id = $soft->id;
        $orderService->price = 0;
        $saved = $orderService->save();
    }
}
