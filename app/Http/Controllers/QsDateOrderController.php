<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\QsDateOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QsDateOrderController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QsDateOrder::all();
        return view('cms.qs-order.date.index',[
            'data' => $data
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Currency::all();
        return view('cms.qs-order.date.create',[
            'currency' => $currency
        ]);   
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
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'price.*' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $qs = new QsDateOrder();
            $qs->qs_ar = $request->input('qs_ar');
            $qs->qs_en = $request->input('qs_en');
            $isSaved = $qs->save();

            foreach(json_decode($request->input('price')) as $price){
                $qs->price()->create([
                    'currency_id' => $price->currncyId,
                    'price' => $price->value
                ]);
            }
            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QsDateOrder  $qsDateOrder
     * @return \Illuminate\Http\Response
     */
    public function show(QsDateOrder $qsDateOrder)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsDateOrder  $qsDateOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(QsDateOrder $qsDateOrder)
    {
        $currency = Currency::all();
        return view('cms.qs-order.date.edit',[
            'data' => $qsDateOrder,
            'currency' => $currency
        ]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsDateOrder  $qsDateOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsDateOrder $qsDateOrder)
    {
        $validator = Validator($request->all(), [
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'price.*' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $qsDateOrder->qs_ar = $request->input('qs_ar');
            $qsDateOrder->qs_en = $request->input('qs_en');
            $isSaved = $qsDateOrder->save();

            $qsDateOrder->price()->delete();
            foreach(json_decode($request->input('price')) as $price){
                $qsDateOrder->price()->create([
                    'currency_id' => $price->currncyId,
                    'price' => $price->value
                ]);
            }
            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QsDateOrder  $qsDateOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsDateOrder $qsDateOrder)
    {
        return $this->destroyTrait($qsDateOrder);
    }
}
