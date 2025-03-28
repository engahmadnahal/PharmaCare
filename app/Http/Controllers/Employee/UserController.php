<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function show(User $user)
    {
        $user->load(['info', 'drugs', 'medicalRecords', 'orders']);

        // Get orders statistics
        $orderStats = [
            'total_orders' => $user->orders->count(),
            'total_spent' => $user->orders->sum('total'),
            'completed_orders' => $user->orders->where('status', 'completed')->count(),
            'pending_orders' => $user->orders->where('status', 'pending')->count()
        ];
        return view('cms.users.show', ['user' => $user, 'orderStats' => $orderStats]);
    }

}
