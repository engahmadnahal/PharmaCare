<?php

namespace App\Http\Controllers;

use App\Exports\OrderStatusReport;
use App\Exports\StudioPerformanceReport;
use App\Helpers\ControllersService;
use App\Models\City;
use App\Models\FrameAlbumBooking;
use App\Models\FramesOrAlbum;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\PackgePosterService;
use App\Models\PassportBooking;
use App\Models\PassportOption;
use App\Models\PaymentOrder;
use App\Models\PostcardBooking;
use App\Models\PosterBooking;
use App\Models\Product;
use App\Models\ProductBooking;
use App\Models\SoftcopyBooking;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Models\StudioProduct;
use App\Models\SubOptionPostcardService;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    /**
     * -----------------------------------------------------
     * Export Order Excel file By Status #Done
     * -----------------------------------------------------
     */

    public function orderStatusReportIndex(Request $request)
    {

        $validator = Validator($request->all(), [
            'order_status_in_user'      => 'nullable|integer|exists:order_statuses,id',
            'order_status_in_studio'    => 'nullable|string|in:wait,finsh,underway',
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $orderStatus = OrderStatus::where('active', true)->get();

            $data = Order::with(['services', 'studioSendOrder', 'user', 'currency'])
                ->when(auth('studiobranch')->check(), function ($q) {
                    $q->where('studio_branch_id', auth('studiobranch')->user()->id);
                })
                ->when($request->order_status_in_user, function ($q) use ($request) {
                    $q->where('order_status_id', $request->order_status_in_user);
                })
                ->when($request->order_status_in_studio, function ($q) use ($request) {
                    $q->where('status', $request->order_status_in_studio);
                })
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->paginate(50);


            foreach ($data as $order) {
                $servicesName = [];
                foreach ($order->services as $service) {
                    $object = $this->getObjectMorph($service->object_type);
                    if (count($servicesName) > 3) {
                        break;
                    }

                    if (isset($object)) {
                        $servicesName[] = $object;
                    }
                }
                $order->setAttribute('servicesType', join('/',  $servicesName));
            }

            return view('cms.reports.order-status', [
                'data' => $data,
                'orderStatus' => $orderStatus
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function orderStatusReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'order_status_in_user' => 'nullable|integer|exists:order_status,id',
            'order_status_in_studio' => 'nullable|string|in:wait,finsh,underway',
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = Order::with(['services', 'studioSendOrder', 'user', 'currency'])
                ->when(auth('studiobranch')->check(), function ($q) {
                    $q->where('studio_branch_id', auth('studiobranch')->user()->id);
                })
                ->when($request->order_status_in_user, function ($q) use ($request) {
                    $q->where('order_status_id', $request->order_status_in_user);
                })
                ->when($request->order_status_in_studio, function ($q) use ($request) {
                    $q->where('status', $request->order_status_in_studio);
                })
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->get();

            foreach ($data as $order) {
                $servicesName = [];
                foreach ($order->services as $service) {
                    $object = $this->getObjectMorph($service->object_type);
                    if (isset($object)) {
                        $servicesName[] = $object;
                    }
                }
                $order->setAttribute('servicesType', join('/', $servicesName));
            }

            // Export Excel File
            $date = now()->format('Ymd');
            return Excel::download(new OrderStatusReport($data), "order-status-$date.xlsx");
        } else {
            return back();
        }
    }

    /**
     * -----------------------------------------------------
     * Export Excel File For Performance Studio #Done
     * -----------------------------------------------------
     */

    public function studioPerformanceReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->paginate(50);

            return view('cms.reports.studio-performance', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function studioPerformanceReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }

    /**
     * -----------------------------------------------------
     * Export Excel File For Details Services Sales #Wait
     * -----------------------------------------------------
     */

    public function detailsServicesSalesReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->paginate(50);

            return view('cms.reports.details-services-sales', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function detailsServicesSalesReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }


    /**
     * -----------------------------------------------------
     * Export Excel File For Area Performance #Wait
     * -----------------------------------------------------
     */

    public function areaPerformanceReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            

            $data = UserAddress::query()
                ->has('orders')
                ->with('city')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->withSum('orders', 'cost')
                ->withCount('orders')
                ->groupBy('city_id')
                ->get();

            dd($data);
            return view('cms.reports.area-performance', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function areaPerformanceReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Order Failds #Done
     * -----------------------------------------------------
     */

    public function orderFaildReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $orders = Order::with(['user', 'studioSendOrder'])
                ->whereHas('orderStatus', function ($q) {
                    $q->where('is_faild', true);
                })
                ->paginate(50);

            $data = collect();

            foreach ($orders as $order) {
                foreach ($order->services as $service) {
                    $data->add([
                        'order_id' => $order->order_num,
                        'order_amount' => $order->total . ' ' . $order->currency?->code,
                        'service_type' => $this->orderServiceType($service->object, $service->object_type),
                        'customer_id' => $order->user?->id,
                        'customer_name' => $order->user?->name,
                        'customer_mobile' => $order->user?->mobile,
                        'service_provider' => $order->studioSendOrder?->name ?? 'No Provider',
                        'provider_mobile' => $order->studioSendOrder?->mobile ?? '--',
                        'reject_reason' => $order->note ?? '--',
                        'user_account_status' => $order->user?->status,
                    ]);
                }
            }

            return view('cms.reports.order-failds', [
                'data' => $data,
                'orders' => $orders
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function orderFaildReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $orders = Order::with(['user', 'studioSendOrder'])
                ->whereHas('orderStatus', function ($q) {
                    $q->where('is_faild', true);
                })
                ->get();

            $data = collect();

            foreach ($orders as $order) {
                foreach ($order->services as $service) {
                    $data->add([
                        'order_id' => $order->order_num,
                        'order_amount' => $order->total . ' ' . $order->currency?->code,
                        'service_type' => $this->orderServiceType($service->object, $service->object_type),
                        'customer_id' => $order->user?->id,
                        'customer_name' => $order->user?->name,
                        'customer_mobile' => $order->user?->mobile,
                        'service_provider' => $order->studioSendOrder?->name ?? 'No Provider',
                        'provider_mobile' => $order->studioSendOrder?->mobile ?? '--',
                        'reject_reason' => $order->note ?? '--',
                        'user_account_status' => $order->user?->status,
                    ]);
                }
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Services Report #Done
     * -----------------------------------------------------
     */

    public function servicesReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = collect();

            $postcardData = SubOptionPostcardService::query()
                ->with('sizeOrtype')
                ->withCount('bookings')
                ->withSum('bookings', 'total')
                ->get();

            $posterData = PackgePosterService::query()
                ->with('size')
                ->withCount('bookings')
                ->withSum('bookings', 'total')
                ->get();

            $passportData = PassportOption::get();

            $frameAlbumData = FramesOrAlbum::with(['frameSizes.booking', 'albumSizes.booking'])
                ->get();


            foreach ($postcardData as $item) {
                $data->add([
                    'id' => $item->sizeOrtype->id,
                    'service_name' => $item->sizeOrtype->title_en,
                    'service_type' => 'postcard',
                    'qty' => $item->bookings_count,
                    'amount' => $item->bookings_sum_total ?? 0,
                ]);
            }

            foreach ($posterData as $item) {
                $data->add([
                    'id' => $item->size->id,
                    'service_name' => $item->size->title_en,
                    'service_type' => 'posters',
                    'qty' => $item->bookings_count,
                    'amount' => $item->bookings_sum_total ?? 0,
                ]);
            }

            foreach ($passportData as $item) {

                $passportBooking = PassportBooking::where('passport_type_id', $item->passport_type_id)
                    ->where('passport_country_id', $item->passport_country_id)
                    ->get();

                $data->add([
                    'id' => $item->id,
                    'service_name' => $item->title_en,
                    'service_type' => 'passport',
                    'qty' => $passportBooking->count(),
                    'amount' => $passportBooking->sum('total') ?? 0,
                ]);
            }

            foreach ($frameAlbumData as $item) {

                $info = [
                    'id' => $item->id,
                    'service_name' => $item->title_en,
                    'service_type' => 'frame & Album',
                ];

                if ($item->type == 'frame') {
                    foreach ($item->frameSizes as $frame) {
                        $info['qty'] = $frame?->booking?->sum('quantity') ?? 0;
                        $info['amount'] = $frame?->booking?->sum('total') ?? 0;
                    }
                }

                if ($item->type == 'album') {

                    foreach ($item->albumSizes as $album) {
                        $info['qty'] = $album?->booking?->sum('quantity') ?? 0;
                        $info['amount'] = $album?->booking?->sum('total') ?? 0;
                    }
                }

                $data->add($info);
            }

            return view('cms.reports.services', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function servicesReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = collect();

            $postcardData = SubOptionPostcardService::query()
                ->with('sizeOrtype')
                ->withCount('bookings')
                ->withSum('bookings', 'total')
                ->get();

            $posterData = PackgePosterService::query()
                ->with('size')
                ->withCount('bookings')
                ->withSum('bookings', 'total')
                ->get();

            $passportData = PassportOption::get();

            $frameAlbumData = FramesOrAlbum::with(['frameSizes.booking', 'albumSizes.booking'])
                ->get();


            foreach ($postcardData as $item) {
                $data->add([
                    'id' => $item->sizeOrtype->id,
                    'service_name' => $item->sizeOrtype->title_en,
                    'service_type' => 'postcard',
                    'qty' => $item->bookings_count,
                    'amount' => $item->bookings_sum_total ?? 0,
                ]);
            }

            foreach ($posterData as $item) {
                $data->add([
                    'id' => $item->size->id,
                    'service_name' => $item->size->title_en,
                    'service_type' => 'posters',
                    'qty' => $item->bookings_count,
                    'amount' => $item->bookings_sum_total ?? 0,
                ]);
            }

            foreach ($passportData as $item) {

                $passportBooking = PassportBooking::where('passport_type_id', $item->passport_type_id)
                    ->where('passport_country_id', $item->passport_country_id)
                    ->get();

                $data->add([
                    'id' => $item->id,
                    'service_name' => $item->title_en,
                    'service_type' => 'passport',
                    'qty' => $passportBooking->count(),
                    'amount' => $passportBooking->sum('total') ?? 0,
                ]);
            }

            foreach ($frameAlbumData as $item) {

                $info = [
                    'id' => $item->id,
                    'service_name' => $item->title_en,
                    'service_type' => 'frame & Album',
                ];

                if ($item->type == 'frame') {
                    foreach ($item->frameSizes as $frame) {
                        $info['qty'] = $frame?->booking?->sum('quantity') ?? 0;
                        $info['amount'] = $frame?->booking?->sum('total') ?? 0;
                    }
                }

                if ($item->type == 'album') {

                    foreach ($item->albumSizes as $album) {
                        $info['qty'] = $album?->booking?->sum('quantity') ?? 0;
                        $info['amount'] = $album?->booking?->sum('total') ?? 0;
                    }
                }

                $data->add($info);
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "service-report-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Stock Balance #Done
     * -----------------------------------------------------
     */

    public function stockBalanceReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = Product::with('price.currency')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->paginate(50);

            foreach ($data as $item) {

                $soldItem = 0;
                $itemCost = [];
                $totalCost = [];


                if ($item->type == 'user') {

                    $soldItem += OrderService::where('object_type', ProductBooking::class)
                        ->where('object_id', $item->id)
                        ->count();

                    foreach ($item->price as $price) {
                        $itemCost[] = $price->price . ' ' . $price->currency?->code;
                        $totalCost[] = ($price->price * $item->num_items) . ' ' . $price->currency?->code;
                    }

                    $item->setAttribute('item_cost', join(' | ', $itemCost));
                    $item->setAttribute('total_cost', join(' | ', $totalCost));
                }

                if ($item->type == 'studio') {

                    $soldItem += StudioProduct::where('product_id', $item->id)->count();

                    foreach ($item->joomla as $price) {
                        $itemCost[] = $price->price . ' ' . $price->currency?->code;
                        $totalCost[] = ($price->price * $item->num_items) . ' ' . $price->currency?->code;
                    }

                    $item->setAttribute('item_cost', join(' | ', $itemCost));
                    $item->setAttribute('total_cost', join(' | ', $totalCost));
                }

                $item->setAttribute('sold_item', $soldItem);
            }

            return view('cms.reports.stock-balance', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function stockBalanceReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = Product::with('price.currency')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->get(50);

            foreach ($data as $item) {

                $soldItem = 0;
                $itemCost = [];
                $totalCost = [];


                if ($item->type == 'user') {

                    $soldItem += OrderService::where('object_type', ProductBooking::class)
                        ->where('object_id', $item->id)
                        ->count();

                    foreach ($item->price as $price) {
                        $itemCost[] = $price->price . ' ' . $price->currency?->code;
                        $totalCost[] = ($price->price * $item->num_items) . ' ' . $price->currency?->code;
                    }

                    $item->setAttribute('item_cost', join(' | ', $itemCost));
                    $item->setAttribute('total_cost', join(' | ', $totalCost));
                }

                if ($item->type == 'studio') {

                    $soldItem += StudioProduct::where('product_id', $item->id)->count();

                    foreach ($item->joomla as $price) {
                        $itemCost[] = $price->price . ' ' . $price->currency?->code;
                        $totalCost[] = ($price->price * $item->num_items) . ' ' . $price->currency?->code;
                    }

                    $item->setAttribute('item_cost', join(' | ', $itemCost));
                    $item->setAttribute('total_cost', join(' | ', $totalCost));
                }

                $item->setAttribute('sold_item', $soldItem);
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Clearance #Done
     * -----------------------------------------------------
     */

    public function clearanceReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = PaymentOrder::with('order.studioSendOrder')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->paginate(50);

            foreach ($data as $payment) {
                $totalOrder = $payment->amount;
                $photomeRate = $totalOrder * 0.25;
                $banckFees = $totalOrder * 0.025;
                $netValue = $totalOrder - ($photomeRate + $banckFees);

                $payment->setAttribute('photome_rate', $photomeRate);
                $payment->setAttribute('net_value', $netValue);
                $payment->setAttribute('fees', $banckFees);
            }

            return view('cms.reports.clearance', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function clearanceReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = PaymentOrder::with('order.studioSendOrder')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereBetween('created_at', [$request->from, $request->to]);
                })
                ->get();

            foreach ($data as $payment) {
                $totalOrder = $payment->amount;
                $photomeRate = $totalOrder * 0.25;
                $banckFees = $totalOrder * 0.025;
                $netValue = $totalOrder - ($photomeRate + $banckFees);

                $payment->setAttribute('photome_rate', $photomeRate);
                $payment->setAttribute('net_value', $netValue);
                $payment->setAttribute('fees', $banckFees);
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Financial Cash #Done
     * -----------------------------------------------------
     */

    public function financialCashReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->where('payment_way', 'on_receipt')
                            ->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->paginate(50);

            foreach ($data as $std) {
                $totalOrder = $std->orders->sum('cost');
                $photomeRate = $totalOrder * 0.25;
                $netValue = $totalOrder - $photomeRate;
                $std->setAttribute('photome_rate', $photomeRate);
                $std->setAttribute('net_value', $netValue);
            }

            return view('cms.reports.financial-cash', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function financialCashReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->where('payment_way', 'on_receipt')
                            ->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            foreach ($data as $std) {
                $totalOrder = $std->orders->sum('cost');
                $photomeRate = $totalOrder * 0.25;
                $netValue = $totalOrder - $photomeRate;

                $std->setAttribute('photome_rate', $photomeRate);
                $std->setAttribute('net_value', $netValue);
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            // Replance Excel Class <------

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Financial Online #Done
     * -----------------------------------------------------
     */

    public function financialOnlineReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->where('payment_way', 'app')
                            ->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->paginate(50);

            foreach ($data as $std) {
                $totalOrder = $std->orders->sum('cost');
                $photomeRate = $totalOrder * 0.25;
                $banckFees = $totalOrder * 0.025;
                $netValue = $totalOrder - ($photomeRate + $banckFees);

                $std->setAttribute('photome_rate', $photomeRate);
                $std->setAttribute('net_value', $netValue);
                $std->setAttribute('fees', $banckFees);
            }

            return view('cms.reports.financial-online', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function financialOnlineReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->where('payment_way', 'app')
                            ->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            foreach ($data as $std) {
                $totalOrder = $std->orders->sum('cost');
                $photomeRate = $totalOrder * 0.25;
                $banckFees = $totalOrder * 0.025;
                $netValue = $totalOrder - ($photomeRate + $banckFees);

                $std->setAttribute('photome_rate', $photomeRate);
                $std->setAttribute('net_value', $netValue);
                $std->setAttribute('fees', $banckFees);
            }

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            // Replance Excel Class <------

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }



    /**
     * -----------------------------------------------------
     * Export Excel File For Performance Report #Wait
     * -----------------------------------------------------
     */

    public function performanceReportIndex(Request $request)
    {
        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->paginate(50);

            return view('cms.reports.performance', [
                'data' => $data,
            ]);
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    public function performanceReportExcel(Request $request)
    {

        $validator = Validator($request->all(), [
            'from'                      => 'nullable|date',
            'to'                        => 'nullable|date',
        ]);

        if (!$validator->fails()) {

            $data = StudioBranch::query()->withCount('orders')
                ->with('orders')
                ->when($request->from && $request->to, function ($q) use ($request) {
                    $q->whereHas('orders', function ($q) use ($request) {
                        $q->whereBetween('created_at', [$request->from, $request->to]);
                    });
                })
                ->withSum('orders', 'cost')
                ->get();

            // Export Excel File
            $date = now()->format('Ymd');
            $filterDate = [$request->from, $request->to];

            return Excel::download(new StudioPerformanceReport($data, $filterDate), "studio-performance-$date.xlsx");
        } else {
            return back();
        }
    }




    /**
     * -----------------------------------------------------
     * General Function and data
     * -----------------------------------------------------
     */


    private function orderServiceType($object, $type)
    {

        if (is_null($object)) {
            return "--";
        }

        switch ($type) {
            case PosterBooking::class:
                return $object?->package?->title ?? '';
                break;

            case PostcardBooking::class:
                return $object?->subOptions?->title ?? '';
                break;

            case FrameAlbumBooking::class:
                return $object?->size?->title ?? '';
                break;

            case PassportBooking::class:

                $data = PassportOption::where('passport_type_id', $object->passport_type_id)
                    ->where('passport_country_id', $object->passport_country_id)
                    ->first();

                return $data?->title ?? '';
                break;

            case SoftcopyBooking::class:
                return $object?->softcopy?->title ?? '';
                break;

            case StudioBooking::class:
                return $object?->service?->title ?? '';
                break;
        }
    }

    private function getObjectMorph($obj)
    {
        switch ($obj) {
            case PosterBooking::class:
                return "Poster";
                break;

            case PostcardBooking::class:
                return "Postcard";
                break;

            case FrameAlbumBooking::class:
                return "Framd&Album";
                break;

            case PassportBooking::class:
                return "Passport";
                break;

            case SoftcopyBooking::class:
                return "SoftCopy";
                break;

            case StudioBooking::class:
                return "Studio Booking";
                break;
        }
    }
}
