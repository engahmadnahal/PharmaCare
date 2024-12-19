<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\PaymentGatWay;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentGatWayController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = PaymentGatWay::all();
        return view('cms.payments.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.payments.create');
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
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
            'active' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $paymentGatWay = new PaymentGatWay();
            $paymentGatWay->title = $request->input('title');
            $paymentGatWay->image = $this->uploadFile($request->file('image'));
            $paymentGatWay->active = $request->input('active');
            $paymentGatWay->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentGatWay  $paymentGatWay
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGatWay $paymentGatWay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentGatWay  $paymentGatWay
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGatWay $paymentGatWay)
    {
        return view('cms.payments.edit',['paymentGatWay' => $paymentGatWay]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentGatWay  $paymentGatWay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentGatWay $paymentGatWay)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
            'active' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $paymentGatWay->title = $request->input('title');
            if($request->hasFile('image')){
                $paymentGatWay->image = $this->uploadFile($request->file('image'));
            }
            $paymentGatWay->active = $request->input('active');
            $paymentGatWay->save();
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentGatWay  $paymentGatWay
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGatWay $paymentGatWay)
    {
        $paymentGatWay->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
