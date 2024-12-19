<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\FrameAlbumBooking;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\PassportBooking;
use App\Models\PassportOption;
use App\Models\PostcardBooking;
use App\Models\PosterBooking;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Notifications\NewOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class OrderStudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if (auth('studio')->check()) {

            $stds = StudioBranch::where('studio_id', auth('studio')->user()->id)->pluck('id');
            $data = Order::with(['orderStatus', 'studioSendOrder', 'services', 'user', 'paymentOrder'])
                ->whereIn('studio_branch_id', $stds)
                ->orderBy('created_at', 'desc')
                ->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })->paginate(100);

            return view('cms.orders.index', ['data' => $data]);
        } else if (auth('studiobranch')->check()) {

            $data = Order::with(['orderStatus', 'studioSendOrder', 'services', 'user', 'paymentOrder'])
                ->where('studio_branch_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })->paginate(100);

            return view('cms.orders.index', ['data' => $data]);
        } else {

            $studios = StudioBranch::where('active', true)->get();
            $data = Order::with(['orderStatus', 'studioSendOrder', 'services', 'user', 'paymentOrder'])
                ->where('isSoftCopy', false)
                ->orderBy('created_at', 'desc')
                ->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })->paginate(100);

            return view('cms.orders.index', ['data' => $data, 'studios' => $studios]);
        }
    }


    public function detials($type, $id, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $typeService = Crypt::decryptString($type);
        return $this->viewService($typeService, $id, $order);
    }


    private function viewService($type, $id, $order)
    {
        switch ($type) {
            case PostcardBooking::class;

                $data = PostcardBooking::find($id);
                return view('cms.orders.booking.postcard', ['data' => $data, 'order' => $order]);
                break;

            case PosterBooking::class;

                $data = PosterBooking::find($id);
                return view('cms.orders.booking.poster', ['data' => $data, 'order' => $order]);
                break;

            case PassportBooking::class;

                $data = PassportBooking::find($id);
                $detailsOptionPassport = PassportOption::where('passport_type_id', $data->passport_type_id)
                    ->where('passport_country_id', $data->passport_country_id)
                    ->first();

                return view('cms.orders.booking.passport', ['data' => $data, 'order' => $order, 'detailsOptionPassport' => $detailsOptionPassport]);
                break;

            case FrameAlbumBooking::class;

                $data = FrameAlbumBooking::find($id);
                return view('cms.orders.booking.frame', ['data' => $data, 'order' => $order]);
                break;

            case StudioBooking::class;

                $data = StudioBooking::find($id);
                return view('cms.orders.booking.studio', ['data' => $data, 'order' => $order]);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (is_numeric($id)) {
            // For Go Order Using Notification Order
            $orderNum = Order::findOrFail($id);
            $id = $orderNum->order_num;
        }

        if (auth('studiobranch')->check()) {
            $order = Order::where('studio_branch_id', auth('studiobranch')->user()->id)->where('order_num', $id)->first();
        } else if (auth('studio')->check()) {
            $stds = StudioBranch::where('studio_id', auth('studio')->user()->id)->pluck('id');
            $order = Order::whereIn('studio_branch_id', $stds)->where('order_num', $id)->first();
        } else {
            $order = Order::where('order_num', $id)->first();
        }

        if (is_null($order)) {
            return abort(404);
        }

        $servicesOrder = $order->services;
        $orderStatus = OrderStatus::where('active',true)->get();

        return view('cms.orders.show', [
            'data' => $order,
            'orderStatus' => $orderStatus,
            'servicesOrder' => $servicesOrder
        ]);
    }

    public function download($type, $bookingId, $userId, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            if (auth('studiobranch')->check()) {
                $order->status = 'underway';
                $order->save();
            }
            $typeService = Crypt::decryptString($type);
            $zip_file = "order-{$order->order_num}.zip";
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $path = $this->filePath($typeService, $bookingId, $userId);

            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    // extracting filename with substr/strlen
                    $relativePath = "order-{$order->order_num}/booking/" . substr($filePath, strlen($path) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $detailsService = $this->detailsService($typeService, $bookingId);
            // $date = Carbon::parse($order->created_at)->format('Y-m-d H:i');
            $details = $this->detailsPrint($order) ?? 'No Choice';
            $dataDetials = "
                Order Num : {$order->order_num}\n
                User Name : {$order->user->name}\n
                Subtotal : {$order->subtotal}\n
                Tax : {$order->tax}\n
                Total : {$order->total}\n
                Delivery : {$order->delivery}\n
                Discount : {$order->discount}\n
                Cost : {$order->cost}\n
                Receiving : {$order->receiving}\n
                ============================\n
                Address : {$order->userAddress?->fullAddress}\n
                Received date : {$order->orderDate?->title}\n
                ============================\n
                Print Method : {$details}
                ============================\n
                Services Details : \n
                {$detailsService}


            ";
            Storage::put('order/invoice.txt', $dataDetials);
            $relativePathDetials = "order-{$order->order_num}/detials/invoice.txt";
            $zip->addFile(storage_path('app/public/order/invoice.txt'), $relativePathDetials);
            $zip->close();

            return response()->download($zip_file);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }


    private function detailsPrint(Order $order)
    {
        if ($order->answerGeneralQs->count() > 0) {

            $printMethods = null;
            foreach ($order->answerGeneralQs as $qs) {
                if ($qs->pivot->answer == 'yes') {
                    $printMethods = "$qs->in_report,";
                }
            }
            return $printMethods;
        }
        return null;
    }
    private function filePath($type, $bookingId, $userId)
    {
        switch ($type) {
            case PostcardBooking::class;
                return storage_path("app/public/upload/postcardbooking/user/{$userId}/booking/{$bookingId}");
                break;

            case PosterBooking::class;
                return storage_path("app/public/upload/posterbooking/user/{$userId}/booking/{$bookingId}");
                break;

            case PassportBooking::class;
                return storage_path("app/public/upload/passportbooking/user/{$userId}/booking/{$bookingId}");
                break;

            case FrameAlbumBooking::class;
                return storage_path("app/public/upload/framebooking/user/{$userId}/booking/{$bookingId}");
                break;
        }
    }

    private function detailsService($type, $bookingId)
    {
        switch ($type) {
            case PostcardBooking::class;
                $data = PostcardBooking::find($bookingId);

                $details = "
                        Postcard (Total : {$data->total} {$data->currencyCode} )\n
                        Service : {$data?->masterService->title}\n
                        Size : {$data?->sizeTitle}\n
                        Package : {$data?->subOptions->title}\n
                        Copies : {$data?->copies}\n
                        Photo Number : {$data?->photo_num}\n
                        User Note : {$data?->note}\n
                ";

                return $details;
                break;

            case PosterBooking::class;

                $data = PosterBooking::find($bookingId);

                $details = "
                        Poster (Total : {$data->total} {$data->currencyCode})\n
                        Service : {$data?->masterService?->title}\n
                        Size : {$data?->sizeTitle}\n
                        Package : {$data?->package->title}\n
                        Copies : {$data?->copies}\n
                        Photo Number : {$data?->photo_num}\n
                        Print Type : {$data?->printType->title}\n
                        Photo Frame : {$data?->frameType->title}\n
                        Print Color : {$data?->printColor->title}\n
                        User Note : {$data?->note}\n
                ";

                return $details;

                break;

            case PassportBooking::class;
                $data = PassportBooking::find($bookingId);
                $detailsOptionPassport = PassportOption::where('passport_type_id', $data->passport_type_id)->where('passport_country_id', $data->passport_country_id)->first();

                $details = "
                        Passport (Total : {$data->total} {$data->currencyCode})\n
                        Service : {$data?->masterService?->title}\n
                        Type : {$data?->passportType?->title}({$detailsOptionPassport->title})\n
                        Country : {$data?->passportCountry?->name}\n
                        Quantity : {$data?->quantity}\n
                        User Note : {$data?->note}\n
                ";

                return $details;


                break;

            case FrameAlbumBooking::class;

                $data = FrameAlbumBooking::find($bookingId);

                $details = "
                        Frame & Album (Total : {$data->total} {$data->currencyCode})\n
                        Service : {$data?->masterService->title}\n
                        Type : {$data?->type}\n
                        Frame Choice or Album Choice : {$data?->frameOrAlbum->title}\n
                        Size : {$data?->size?->title}\n
                        Quantity : {$data?->quantity}\n
                ";

                return $details;

                break;

            case StudioBooking::class;
                $data = StudioBooking::find($bookingId);

                $details = "
                        Studio Booking (Total : {$data->total} {$data->currencyCode})\n
                        Service : {$data?->masterService->title}\n
                        User Address : {$data?->user?->defaultAddressString}\n
                        User Name : {$data?->user?->name}\n
                        Studio Name : {$data?->studio?->name}\n
                        Services : {$data?->service?->title}\n
                        Quantity : {$data?->qty}\n
                        People No. : {$data?->people_num}\n
                        Date : {$data?->date}\n
                        Time : {$data?->time_from}\n
                        User Note : {$data?->note}\n
                ";

                return $details;

                break;
            default:
                return "";
        }
    }





    public function downloadAll($userId, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);
            if (auth('studiobranch')->check()) {
                $order->status = 'underway';
                $order->save();
            }
            $order = Order::findOrFail($orderId);

            $zip_file = "order-{$order->order_num}.zip";
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $allBooking = OrderService::where('order_id', $orderId)->get();
            foreach ($allBooking as $booking) {

                if ($booking->object_type == StudioBooking::class) continue;
                $nameFolderSplit = explode('\\', $booking->object_type);
                $nameFolder = $nameFolderSplit[count($nameFolderSplit) - 1] . '_' . $booking->object_id;

                if ($this->checkExistsImageFrame($booking->object_id, $booking->object_type)) {

                    // With Image In Service

                    $path = $this->filePath($booking->object_type, $booking->object_id, $userId);
                    $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

                    foreach ($files as $name => $file) {
                        // We're skipping all subfolders
                        if (!$file->isDir()) {

                            // Download Image
                            $filePath = $file->getRealPath();
                            // extracting filename with substr/strlen
                            $relativePath = "order-{$order->order_num}/booking/$nameFolder/" . substr($filePath, strlen($path) + 1);
                            $zip->addFile($filePath, $relativePath);
                        }
                    }
                }



                // Without Image In Service
                $pathFolderInvoice = "order/temp/{$nameFolder}-{$booking->id}.txt";
                $detailsService = $this->detailsService($booking->object_type, $booking->object_id);
                $details = $this->detailsPrint($order) ?? 'No Choice';
                $detailsInvoice = "
                    Print Method : $details,
                    ============================\n
                    Services Details : \n
                    {$detailsService}";

                Storage::put($pathFolderInvoice, $detailsInvoice);
                $pathInvoice = "order-{$order->order_num}/booking/$nameFolder/invoice.txt";
                $zip->addFile(storage_path("app/public/order/temp/{$nameFolder}-{$booking->id}.txt"), $pathInvoice);
            }


            // General Details 

            $dataDetials = "
                Order Num : {$order->order_num}\n
                User Name : {$order->user->name}\n
                Subtotal : {$order->subtotal}\n
                Tax : {$order->tax}\n
                Total : {$order->total}\n
                Delivary : {$order->delivery}\n
                Discount : {$order->discount}\n
                Cost : {$order->cost}\n
                Receiving : {$order->receiving}\n
                ============================\n
                Address : {$order->userAddress?->fullAddress}\n
                Received date : {$order->date?->title}\n
            ";
            Storage::put('order/invoice.txt', $dataDetials);
            $relativePathDetials = "order-{$order->order_num}/detials/invoice.txt";
            $zip->addFile(storage_path('app/public/order/invoice.txt'), $relativePathDetials);

            $zip->close();

            return response()->download($zip_file);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    private function checkExistsImageFrame($bookingId, $type)
    {

        if ($type != FrameAlbumBooking::class) {
            return true;
        }

        $data = FrameAlbumBooking::find($bookingId);
        return $data->images->count() > 0;
    }

    public function sendToStudio(Request $request)
    {
        $validator = Validator($request->all(), [
            'studio_branch_id' => 'required|integer|exists:studio_branches,id',
            'order_id' => 'required|integer|exists:orders,id'
        ]);
        if (!$validator->fails()) {
            $std = StudioBranch::find($request->studio_branch_id);
            $order = Order::find($request->order_id);
            $order->studio_branch_id = $std->id;
            $saved = $order->save();
            if ($saved) {
                Notification::sendNow($std, new NewOrderNotification([
                    'title' => 'new_order',
                    'body' => 'new_order_body',
                    'total' => $order->cost,
                    'order_id' => $order->id
                ]));
            }
            return ControllersService::generateProcessResponse($saved, 'UPDATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
