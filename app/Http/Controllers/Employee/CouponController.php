<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(10);

        return view('cms.coupon.index', ['data' => $coupons]);
    }

    public function create()
    {
        return view('cms.coupon.create');
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'code' => 'required|string|max:255|unique:coupons,code',
            'discount' => 'required|numeric|min:0',
            'max_uses' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $coupon = Coupon::create($validator->validated());
        return ControllersService::generateProcessResponse((bool) $coupon, 'CREATE');
    }

    public function edit(Coupon $coupon)
    {
        return view('cms.coupon.edit', ['coupon' => $coupon]);
    }


    public function update(Request $request, Coupon $coupon)
    {

        $validator = Validator($request->all(), [
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:0',
            'max_uses' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $updated = $coupon->update($validator->validated());
        return ControllersService::generateProcessResponse((bool) $updated, 'UPDATE');
    }

    public function destroy(Coupon $coupon)
    {
        $deleted = $coupon->delete();

        return ControllersService::generateProcessResponse($deleted, 'DELETE');
    }
}
