<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Delivary;
use App\Models\Order;
use App\Models\Product;
use App\Models\ServiceStudio;
use App\Models\StoreHouse;
use App\Models\Studio;
use App\Models\StudioBranch;
use App\Models\StudioService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if (auth('admin')->check())
            return $this->admin();
        else if (auth('studio')->check())
            return $this->studio();
        else
            return $this->studioBranch();
    }


    private function orderChartForStudio()
    {
        $allStds = StudioBranch::where('studio_id', auth('studio')->user()->id)->pluck('id');

        $data = DB::table('orders')
            ->selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->whereIn('studio_branch_id', $allStds)
            ->where(function ($q) {
                $q->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })
                    ->orWhere('payment_way', 'on_receipt');
            })
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->groupBy('month')
            ->orderBy('month')
            // ->get();
            ->pluck('count');
        return $data;
    }


    private function orderChartForStudioBranch()
    {
        $data = DB::table('orders')
            ->selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->where('studio_branch_id', auth('studiobranch')->user()->id)
            ->where(function ($q) {
                $q->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })
                    ->orWhere('payment_way', 'on_receipt');
            })
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count');
        return $data;
    }


    private function usersChart()
    {
        $data = DB::table('users')
            ->selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->groupBy('month')
            ->orderBy('month')
            // ->get();
            ->pluck('count');
        return $data;
    }

    private function orderChart()
    {
        $data = DB::table('orders')
            ->selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->where(function ($q) {
                $q->where(function ($q) {
                    $q->where('paid_status', true)
                        ->orWhere('payment_way', 'on_receipt');
                })
                    ->orWhere('payment_way', 'on_receipt');
            })
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->groupBy('month')
            ->orderBy('month')
            // ->get();
            ->pluck('count');
        return $data;
    }



    private function studio()
    {
        $stds = StudioBranch::where('studio_id', auth('studio')->user()->id)->pluck('id');
        $currency = auth('studio')->user()->currencyCode;

        $todayAmount = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereDate('created_at', Carbon::today())->get()->sum('cost');
        $weekAmount = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisWeek())->get()->sum('cost');
        $monthAmount = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisMonth())->get()->sum('cost');
        $totalAmount = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->get()->sum('cost');

        $todayOrder = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereDate('created_at', Carbon::today())->count();
        $weekOrder = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisWeek())->count();;
        $monthOrder = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisMonth())->count();
        $totalOrder = Order::whereIn('studio_branch_id', $stds)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();


        $lastStudios = StudioBranch::where('studio_id', auth('studio')->user()->id)->orderBy('created_at', 'desc')->get();
        $orderChart = $this->orderChartForStudio();
        return response()->view('cms.dashboard', [
            'currency' => $currency,
            'lastStudios' => $lastStudios,
            'orderChart' => $orderChart,
            'orderChart' => $orderChart,
            'todayAmount' => $todayAmount,
            'weekAmount' => $weekAmount,
            'monthAmount' => $monthAmount,
            'totalAmount' => $totalAmount,
            'todayOrder' => $todayOrder,
            'weekOrder' => $weekOrder,
            'monthOrder' => $monthOrder,
            'totalOrder' => $totalOrder,
        ]);
    }


    private function studioBranch()
    {
        $std = auth('studiobranch')->user();
        $currency = $std->currencyCode;

        $todayAmount = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereDate('created_at', Carbon::today())->get()->sum('cost');
        $weekAmount = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisWeek())->get()->sum('cost');
        $monthAmount = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisMonth())->get()->sum('cost');
        $totalAmount = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->get()->sum('cost');

        $todayOrder = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereDate('created_at', Carbon::today())->count();
        $weekOrder = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisWeek())->count();;
        $monthOrder = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->whereBetween('created_at', $this->thisMonth())->count();
        $totalOrder = Order::where('studio_branch_id', $std->id)->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();


        $orderChart = $this->orderChartForStudioBranch();
        return response()->view('cms.dashboard', [
            'currency' => $currency,
            'orderChart' => $orderChart,
            'todayAmount' => $todayAmount,
            'weekAmount' => $weekAmount,
            'monthAmount' => $monthAmount,
            'totalAmount' => $totalAmount,
            'todayOrder' => $todayOrder,
            'weekOrder' => $weekOrder,
            'monthOrder' => $monthOrder,
            'totalOrder' => $totalOrder,
        ]);
    }


    private function admin()
    {
        $studios = Studio::count();
        $lastStudios = Studio::orderBy('created_at', 'desc')->take(5)->get();
        $lastUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $users = User::count();
        $contactUs = ContactUs::count();
        $product = Product::count();
        $branches = StudioBranch::count();
        $delivary = Delivary::count();
        $servicesStudio = ServiceStudio::count();
        $storehouse = StoreHouse::count();

        $todayOrder = Order::whereDate('created_at', Carbon::today())->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();
        $weekOrder = Order::whereBetween('created_at', $this->thisWeek())->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();;
        $monthOrder = Order::whereBetween('created_at', $this->thisMonth())->where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();
        $totalOrder = Order::where(function($q){
            $q->where('paid_status',true)
                ->orWhere('payment_way','on_receipt');
        })->count();


        $usersChart = $this->usersChart();
        $orderChart = $this->orderChart();
        return response()->view('cms.dashboard', [
            'orderChart' => $orderChart,
            'todayOrder' => $todayOrder,
            'weekOrder' => $weekOrder,
            'monthOrder' => $monthOrder,
            'totalOrder' => $totalOrder,

            'studios' => $studios,
            'users' => $users,
            'contactUs' => $contactUs,
            'product' => $product,
            'branches' => $branches,
            'delivary' => $delivary,
            'servicesStudio' => $servicesStudio,
            'storehouse' => $storehouse,
            'lastStudios' => $lastStudios,
            'lastUsers' => $lastUsers,
            'usersChart' => $usersChart,
            'orderChart' => $orderChart,
        ]);
    }

    private function thisWeek()
    {
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();
        return [$startWeek, $endWeek];
    }

    private function thisMonth()
    {
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        return [$startMonth, $endMonth];
    }

    public function changeLanguage()
    {
        $newLocale = LaravelLocalization::getCurrentLocale() == 'en' ? 'ar' : 'en';
        App::setLocale($newLocale);
        LaravelLocalization::setLocale($newLocale);
        $url = LaravelLocalization::getLocalizedURL($newLocale, URL::previous(), null, true);
        return redirect()->to($url);
    }
}
