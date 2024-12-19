<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\PricePassportAfterIncrese;
use App\Models\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Current;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Currency::all();
        return view('cms.currency.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.currency.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'code' => 'required|string|min:3,max:3',
        ];
        return $this->createNormal($request,$validator,Currency::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('cms.currency.edit',['data' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $validator = [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',

        ];
        return $this->updateNourmal($request,$validator,$currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $deletedAllPrice = PricingService::where('currency_id',$currency->id);
        if($deletedAllPrice->count() == 0 || $deletedAllPrice->delete()){
            $deletedInc = PricePassportAfterIncrese::where('currency_id',$currency->id);
            if($deletedInc->count() == 0 || $deletedInc->delete()){
                return $this->destroyTrait($currency);
            }
        }
        return response()->json([
            'status' => false,
            'message' =>  Messages::getMessage('ERROR'),
        ], Response::HTTP_BAD_REQUEST);
    }
}
