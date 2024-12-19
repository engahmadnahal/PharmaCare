<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Country;
use App\Models\PassportCountry;
use App\Models\PassportType;
use App\Models\PassportTypeCountry;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PassportTypeController extends Controller
{


    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PassportType::where('active',true)->get();
        return view('cms.passport.types.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cms.passport.types.create');
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
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'required|boolean',
        ];
        return $this->createNormal($request,$validator,PassportType::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PassportType  $passportType
     * @return \Illuminate\Http\Response
     */
    public function show(PassportType $passportType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PassportType  $passportType
     * @return \Illuminate\Http\Response
     */
    public function edit(PassportType $passportType)
    {
        return view('cms.passport.types.edit',['data' => $passportType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PassportType  $passportType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassportType $passportType)
    {
        $validator = [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'required|boolean',
        ];
        return $this->updateNourmal($request,$validator,$passportType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PassportType  $passportType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassportType $passportType)
    {
        return $this->destroyTrait($passportType);
    }


    public function showCountries(PassportType $passportType){
        $countries = PassportCountry::where('active',true)->get();
        $countryPassports = $passportType->countries;
        foreach($countries as $country){
            $country->setAttribute('assign',false);
            foreach($countryPassports as $countryPassport){
                if($country->id == $countryPassport->id){
                    $country->setAttribute('assign',true);
                }
            }
        }
        return view('cms.passport.counties',['data' => $countries,'passportType' => $passportType]);
    }

    public function setCountries(Request $request,PassportType $passportType){
        $validator = Validator($request->all(), [
            'countryId.*' => 'required|integer|exists:passport_countries,id'
        ]);
        if (!$validator->fails()) {
                $passportType->countries()->sync($request->input('countryId'));
            
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }
}
