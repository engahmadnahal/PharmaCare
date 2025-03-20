<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    // index , show 
    public function index()
    {
        $orders = Order::paginate(10);
        return view('cms.orders.index', ['data' => $orders]);
    }

    public function show(Order $order)
    {
        return view('cms.orders.show', ['data' => $order]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validator = Validator($request->all(), [
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $updated = $order->update(['status' => $request->status]);
        return ControllersService::generateProcessResponse((bool)$updated, 'UPDATE');
    }
}
