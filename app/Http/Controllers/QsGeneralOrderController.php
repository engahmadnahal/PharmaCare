<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\QsGeneralOrder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QsGeneralOrderController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QsGeneralOrder::all();
        return view('cms.qs-order.general.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $currency = Currency::all();
        return view('cms.qs-order.general.create',[
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
            'in_report' => 'required|string',
            'price.*' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $qs = new QsGeneralOrder();
            $qs->qs_ar = $request->input('qs_ar');
            $qs->qs_en = $request->input('qs_en');
            $qs->in_report = $request->input('in_report');
            $isSaved = $qs->save();

            $dataInsert = [];
            foreach(json_decode($request->input('price')) as $price){
                $dataInsert[] = [
                    'currency_id' => $price->currncyId,
                    'price' => $price->value
                ];
            }
            $qs->price()->insert($dataInsert);
            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QsGeneralOrder  $qsGeneralOrder
     * @return \Illuminate\Http\Response
     */
    public function show(QsGeneralOrder $qsGeneralOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsGeneralOrder  $qsGeneralOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(QsGeneralOrder $qsGeneralOrder)
    {
        //
        $currency = Currency::all();
        return view('cms.qs-order.general.edit',[
            'data' => $qsGeneralOrder,
            'currency' => $currency
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsGeneralOrder  $qsGeneralOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsGeneralOrder $qsGeneralOrder)
    {
        //
        $validator = Validator($request->all(), [
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'in_report' => 'required|string',
            'price.*' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $qsGeneralOrder->qs_ar = $request->input('qs_ar');
            $qsGeneralOrder->qs_en = $request->input('qs_en');
            $qsGeneralOrder->in_report = $request->input('in_report');
            $isSaved = $qsGeneralOrder->save();

            $qsGeneralOrder->price()->delete();
            foreach(json_decode($request->input('price')) as $price){
                $qsGeneralOrder->price()->create([
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
     * @param  \App\Models\QsGeneralOrder  $qsGeneralOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsGeneralOrder $qsGeneralOrder)
    {
        return $this->destroyTrait($qsGeneralOrder);
        //
    }
}
