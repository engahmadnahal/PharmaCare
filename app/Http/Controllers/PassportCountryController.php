<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\Country;
use App\Models\Currency;
use App\Models\PassportCountry;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PassportCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PassportCountry::all();
        return view('cms.countries.passport.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.countries.passport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $country = new PassportCountry();
            $country->name_ar = $request->input('name_ar');
            $country->name_en = $request->input('name_en');
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
     * @param  \App\Models\PassportCountry  $passportCountry
     * @return \Illuminate\Http\Response
     */
    public function show(PassportCountry $passportCountry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PassportCountry  $passportCountry
     * @return \Illuminate\Http\Response
     */
    public function edit(PassportCountry $passportCountry)
    {
        //
        return view('cms.countries.passport.edit',['country' => $passportCountry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PassportCountry  $passportCountry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassportCountry $passportCountry)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $passportCountry->name_ar = $request->input('name_ar');
            $passportCountry->name_en = $request->input('name_en');
            $passportCountry->active = $request->input('active');
            $passportCountry->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PassportCountry  $passportCountry
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassportCountry $passportCountry)
    {
        $isDelete = $passportCountry->delete();
        return ControllersService::generateProcessResponse($isDelete,'DELETE');
    }
}
