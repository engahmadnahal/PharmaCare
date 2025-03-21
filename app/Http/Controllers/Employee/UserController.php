<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // index
    public function index()
    {
        $data = User::paginate(10);
        return view('cms.users.index', ['data' => $data]);
    }


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

    public function updateStatus(User $user)
    {
        $update = $user->update(['status' => !$user->status]);
        return ControllersService::generateProcessResponse((bool) $update, 'UPDATE');
    }
}
