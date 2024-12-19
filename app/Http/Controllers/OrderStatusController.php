<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\OrderStatus;
use Carbon\Traits\Cast;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OrderStatus::all();
        return view('cms.order-status.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'active' => 'required|boolean',
            'is_faild' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $orderStatus = new OrderStatus();
            $orderStatus->name_en = $request->input('name_en');
            $orderStatus->name_ar = $request->input('name_ar');
            $orderStatus->active = $request->input('active');
            $orderStatus->is_faild = $request->input('is_faild');
            $isSaved = $orderStatus->save();
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatus $orderStatus)
    {
        return view('cms.order-status.edit', ['data' => $orderStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderStatus $orderStatus)
    {
        $validator = Validator($request->all(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'active' => 'required|boolean',
            'is_faild' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $orderStatus->name_en = $request->input('name_en');
            $orderStatus->name_ar = $request->input('name_ar');
            $orderStatus->active = $request->input('active');
            $orderStatus->is_faild = $request->input('is_faild');
            $isSaved = $orderStatus->save();
            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatus $orderStatus)
    {
        return $this->destroyTrait($orderStatus);
    }
}
