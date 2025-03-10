<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\StudioBranch;
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
        if (auth('admin')->check()) {
            return $this->admin();
        }

        return $this->employee();
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



    private function employee()
    {
        return response()->view('cms.dashboard', [
            'currency' => 'USD',
            'orderChart' => 0,
            'orderChart' => 0,
            'todayAmount' => 0,
            'weekAmount' => 0,
            'monthAmount' => 0,
            'totalAmount' => 0,
            'todayOrder' => 0,
            'weekOrder' => 0,
            'monthOrder' => 0,
            'totalOrder' => 0,
        ]);
    }


    private function admin()
    {
        $studios = 0;
        $lastStudios = collect([]);
        $lastUsers = collect([]);
        $users = 0;
        $contactUs = 0;
        $product = 0;
        $branches = 0;
        $delivary = 0;
        $servicesStudio = 0;
        $storehouse = 0;

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
        $totalOrder = Order::where(function ($q) {
            $q->where('paid_status', true)
                ->orWhere('payment_way', 'on_receipt');
        })->count();


        return response()->view('cms.dashboard', [
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
