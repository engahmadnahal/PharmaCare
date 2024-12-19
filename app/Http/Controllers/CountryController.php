<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Country::withCount('cities')->get();
        return view('cms.countries.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Currency::all();
        return view('cms.countries.create',['currency' => $currency]);
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            // 'longitude' => 'required|string',
            // 'latitude' => 'required|string',
            // 'tax' => 'required|numeric',
            'active' => 'required|boolean',
            'currency_id' => 'required|numeric|exists:currencies,id',
            'code' => 'required|string|unique:countries,code',
        ]);
        if (!$validator->fails()) {
            $country = new Country();
            $country->name_ar = $request->input('name_ar');
            $country->name_en = $request->input('name_en');
            // $country->longitude = $request->input('longitude');
            // $country->latitude = $request->input('latitude');
            $country->code = $request->input('code');
            // $country->tax = $request->input('tax');
            $country->currency_id = $request->input('currency_id');
            $country->active = $request->input('active');
            $country->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $currency = Currency::all();
        return view('cms.countries.edit',['country' => $country,'currency' => $currency]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            // 'longitude' => 'required|string',
            // 'latitude' => 'required|string',
            'active' => 'required|boolean',
            // 'tax' => 'required|numeric',
            'currency_id' => 'required|numeric|exists:currencies,id',
            'code' => 'required|string|unique:countries,code,'.$country->id,
        ]);
        if (!$validator->fails()) {
            $country->name_ar = $request->input('name_ar');
            $country->name_en = $request->input('name_en');
            // $country->longitude = $request->input('longitude');
            // $country->latitude = $request->input('latitude');
            $country->code = $request->input('code');
            // $country->tax = $request->input('tax');
            $country->currency_id = $request->input('currency_id');
            $country->active = $request->input('active');
            $country->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $isDelete = $country->delete();
        return ControllersService::generateProcessResponse($isDelete,'DELETE');
    }
}
