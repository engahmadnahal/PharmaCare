<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\Api\MyCartController;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\SoftcopyBooking;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function indexSoftCopy()
    {
        $data = SoftcopyBooking::orderBy('created_at', 'desc')->get();
        return view('cms.orders.admin.index', [
            'data' => $data
        ]);
    }


    public function detials(SoftcopyBooking $softcopyBooking)
    {
        $user = $softcopyBooking->user;
        $orderStatus = OrderStatus::all();
        $order = Order::where('softcopy_booking_id', $softcopyBooking->id)->first();
        return view('cms.orders.admin.softcopy', ['data' => $softcopyBooking, 'user' => $user, 'orderStatus' => $orderStatus, 'order' => $order]);
    }


    ///For SoftCopy
    public function accepted(Request $request, SoftcopyBooking $softcopyBooking)
    {
        $validator = Validator($request->all(), [
            'note_admin_ar' => 'nullable|string|max:255',
            'note_admin_en' => 'nullable|string|max:255',
            // 'currency_id' => 'required|numeric|exists:currencies,id',
            'price' => 'required|numeric',
            'order_status' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $softcopyBooking->accepted = true;
            $softcopyBooking->note_admin_ar = $request->note_admin_ar;
            $softcopyBooking->note_admin_en = $request->note_admin_en;
            $softcopyBooking->currency_id = $softcopyBooking->user->currency;
            $softcopyBooking->price = $request->price;
            $saved = $softcopyBooking->save();

            if ($saved) {
                $this->createOrder($softcopyBooking, $request);
            }
            return ControllersService::generateProcessResponse($saved, 'ACCEPT');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function download($bookingId, $userId)
    {
        try {
            $zip_file = "order-softcopy-{$userId}.zip";
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            $path = storage_path("app/public/upload/softcopy/user/{$userId}/booking/{$bookingId}");
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    // extracting filename with substr/strlen
                    $relativePath = "order-{$userId}/booking/" . substr($filePath, strlen($path) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zip_file);
        } catch (Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.some_error'));
        }
    }




    private function createOrder($soft, $request)
    {
        $order = new Order();
        $order->softcopy_booking_id = $soft->id;
        $order->isSoftCopy = true;
        $order->isSendToStduio = false;
        $order->isStudioBooking = false;
        $order->order_status_id = $request->order_status;
        $order->order_num = 'OU' . auth()->user()->id . '-' . Carbon::now()->format('Ymd') . '-SOFT-' . Str::upper(Str::random(3));
        $order->user_id = $soft->user->id;
        $order->payment_way = 'app';
        $order->receiving = 'print_center';
        $order->cost = $request->price + $this->taxSoft($soft, $request->price);
        $order->subtotal = $request->price;
        $order->total = $request->price;
        $order->discount = 0;
        $order->delivery = 0;
        $order->tax = $this->taxSoft($soft, $request->price);
        $order->currency_id = $soft->user->currency;
        $order->username = $soft->user->name;
        $order->usermobile = $soft->user->mobile;
        $saved = $order->save();
        if ($saved) {
            $this->setService($order, $soft, $request->price);
        }
        return $order;
    }

    private function taxSoft($soft, $price)
    {
        $tax = $soft->softcopy->tax;
        $isTax = $soft->softcopy->is_tax;
        if ($isTax) {
            return $price * ($tax / 100);
        }
        return 0;
    }

    private function setService($order, $soft, $price)
    {
        $orderService = new OrderService();
        $orderService->order_id = $order->id;
        $orderService->object_type = SoftcopyBooking::class;
        $orderService->object_id = $soft->id;
        $orderService->price = $price;
        $orderService->save();
    }

    public function changeStatus(Request $request)
    {
        $validator = Validator($request->all(), [
            'order_id' => 'required|integer|exists:orders,id',
            'order_status' => 'required|string',
            'note' => 'nullable|string',
        ]);
        if (!$validator->fails()) {

            $orderStatus = OrderStatus::find($request->order_status);
            if (is_null($orderStatus) && $request->order_status != 'finsh') {

                return response()->json([
                    'status' => false,
                    'message' => Messages::getMessage('NOT_FOUND')
                ], Response::HTTP_BAD_REQUEST);
            }

            if($orderStatus->is_faild && is_null($request->note)){
                return ControllersService::generateValidationErrorMessage('Note is required !');
            }

            $order = Order::find($request->order_id);
            if ($request->order_status != 'finsh') {
                $order->note = $request->note;
                $order->order_status_id = $request->order_status;
            } else {
                $order->status = "finsh";
            }
            $saved = $order->save();
            return ControllersService::generateProcessResponse($saved, 'UPDATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
