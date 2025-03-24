<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Pharmaceutical;
use App\Models\Product;
use App\Models\StudioBranch;
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
        if (auth('admin')->check()) {
            return $this->admin();
        }

        return $this->employee();
    }



    private function employee()
    {
        $data = [
            // Basic Stats
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'totalCoupons' => Coupon::count(),

            // Recent Orders
            'recentOrders' => Order::with('user')
                ->latest()
                ->take(5)
                ->get(),

            // Recent Products
            'recentProducts' => Product::latest()
                ->take(5)
                ->get(),

            // Chart Data
            'orderChartData' => Order::selectRaw('COUNT(*) as count, DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date')
                ->take(7)
                ->pluck('count')
                ->toArray(),

            'orderChartLabels' => Order::selectRaw('DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date')
                ->take(7)
                ->pluck('date')
                ->toArray(),

            'userChartData' => User::selectRaw('COUNT(*) as count, DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date')
                ->take(7)
                ->pluck('count')
                ->toArray(),

            'userChartLabels' => User::selectRaw('DATE(created_at) as date')
                ->groupBy('date')
                ->orderBy('date')
                ->take(7)
                ->pluck('date')
                ->toArray(),
        ];

        return response()->view('cms.indexes.employee', $data);
    }


    private function admin()
    {
        // Get counts
        $counts = [
            'orders' => Order::count(),
            'pharmacies' => Pharmaceutical::count(),
            'users' => User::count(),
            'products' => Product::count(),
        ];

        // Calculate totals
        $totals = [
            'orders' => Order::sum('total'),
            'discounts' => Order::sum('discount') + Order::sum('coupon_discount'),
        ];

        // Get latest records
        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $latestUsers = User::latest()
            ->take(5)
            ->get();


        return view('cms.indexes.admin', [
            'counts' => $counts,
            'totals' => $totals,
            'latestOrders' => $latestOrders,
            'latestUsers' => $latestUsers,
        ]);
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
