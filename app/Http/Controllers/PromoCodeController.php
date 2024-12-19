<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\Currency;
use App\Models\PromoCode;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PromoCode::all();
        return view('cms.promo-code.index',[
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
        $currency = Currency::all();
        return view('cms.promo-code.create',[
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
        $validator = Validator($request->all(),[
            'max_usege' => 'required|integer',
            'type' => 'required|string|in:percent,fixed',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'value' => 'required|integer',
            'code' => 'required|string',
            'min_balance.*.currncyId' => 'required|integer',
            'min_balance.*.value' => 'required|numeric',
        ]);

        if(!$validator->fails()){
            $promoCode = new PromoCode();
            $promoCode->max_usege = $request->max_usege;
            $promoCode->type = $request->type;
            $promoCode->title_ar = $request->title_ar;
            $promoCode->title_en = $request->title_en;
            $promoCode->start = $request->start;
            $promoCode->end = $request->end;
            $promoCode->code = $request->code;
            $promoCode->value = $request->value;
            $saved = $promoCode->save();

            try {
                foreach ($request->input('min_balance') as $price) {
                    $price = (object) $price;
                    $promoCode->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }
            } catch (Exception $e) {
                return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
            }
            
            return ControllersService::generateProcessResponse($saved,'CREATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function show(PromoCode $promoCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoCode $promoCode)
    {
        $currency = Currency::all();
        return view('cms.promo-code.edit',[
            'data' => $promoCode,
            'currency' => $currency
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoCode $promoCode)
    {
        $validator = Validator($request->all(),[
            'max_usege' => 'required|integer',
            'type' => 'required|string|in:percent,fixed',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'value' => 'required|integer',
            'code' => 'required|string',
            'min_balance.*.currncyId' => 'required|integer',
            'min_balance.*.value' => 'required|numeric',
        ]);

        if(!$validator->fails()){
            $promoCode->max_usege = $request->max_usege;
            $promoCode->type = $request->type;
            $promoCode->title_ar = $request->title_ar;
            $promoCode->title_en = $request->title_en;
            $promoCode->start = $request->start;
            $promoCode->end = $request->end;
            $promoCode->value = $request->value;
            $promoCode->code = $request->code;
            $saved = $promoCode->save();

                if($promoCode->price()->delete() || $promoCode->price()->count() == 0){
                    foreach ($request->input('min_balance') as $price) {
                        $price = (object) $price;
                        $promoCode->price()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }
                try {
                } catch (Exception $e) {
                return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
            }

            return ControllersService::generateProcessResponse($saved,'UPDATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromoCode  $promoCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promoCode)
    {
        $deleted = $promoCode->delete();
        return ControllersService::generateProcessResponse($deleted,'DELETE');
    }
}
