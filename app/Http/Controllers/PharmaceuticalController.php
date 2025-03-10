<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Models\City;
use App\Models\Country;
use App\Models\Pharmaceutical;
use App\Models\Region;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PharmaceuticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmaceuticals = Pharmaceutical::all();
        return view('cms.pharma.index', ['data' => $pharmaceuticals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('active', true)->get();
        $cities = City::where('active', true)->get();
        $regions = Region::where('active', true)->get();
        return view('cms.pharma.create', ['countries' => $countries, 'cities' => $cities, 'regions' => $regions]);
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'mobile' => 'required|string|unique:doctors,mobile',
            'country_id' => 'required|integer|countries,id',
            'city_id' => 'required|integer|cities,id',
            'region_id' => 'required|integer|regions,id',
            'address' => 'required|string|max:255',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:doctors,national_id',
            'certificate' => 'required|file|mimes:pdf',
            'dob' => 'required|date',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $pharmaceutical = new Pharmaceutical();
            $pharmaceutical->name = $request->input('name');
            $pharmaceutical->country_id = $request->input('country_id');
            $pharmaceutical->city_id = $request->input('city_id');
            $pharmaceutical->region_id = $request->input('region_id');
            $pharmaceutical->dob = $request->input('dob');
            $pharmaceutical->email = $request->input('email');
            $pharmaceutical->mobile = $request->input('mobile');
            $pharmaceutical->address = $request->input('address');
            $pharmaceutical->avater = $this->uploadFile($request->file('avater'));
            $pharmaceutical->certificate = $this->uploadFile($request->file('certificate'));
            $pharmaceutical->national_id = $request->input('national_id');
            $isSave = $pharmaceutical->save();
            if ($isSave) {
                $pharmaceutical->assignRole($role);
            }
            return ControllersService::generateProcessResponse($isSave, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmaceutical $pharmaceutical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmaceutical $pharmaceutical)
    {
        $countries = Country::where('active', true)->get();
        $cities = City::where('active', true)->get();
        $regions = Region::where('active', true)->get();

        return view('cms.pharma.edit', ['data' => $pharmaceutical,  'countries' => $countries, 'cities' => $cities, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmaceutical $pharmaceutical)
    {
        $validator = Validator($request->all(), [
            'country_id' => 'required|integer|countries,id',
            'city_id' => 'required|integer|cities,id',
            'region_id' => 'required|integer|regions,id',
            'dob' => 'required|date',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $pharmaceutical->id,
            'mobile' => 'required|string|unique:doctors,mobile,' . $pharmaceutical->id,
            'address' => 'required|string|max:255',
            'avater' => 'nullable|image|mimes:png,jpg',
            'certificate' => 'nullable|file|mimes:pdf',
            'national_id' => 'required|string|unique:doctors,national_id,' . $pharmaceutical->id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {


            $pharmaceutical->name = $request->input('name');
            $pharmaceutical->email = $request->input('email');
            $pharmaceutical->mobile = $request->input('mobile');
            $pharmaceutical->address = $request->input('address');
            $pharmaceutical->country_id = $request->input('country_id');
            $pharmaceutical->city_id = $request->input('city_id');
            $pharmaceutical->region_id = $request->input('region_id');
            $pharmaceutical->dob = $request->input('dob');
            $pharmaceutical->address = $request->input('national_id');

            if ($request->hasFile('avater')) {
                $pharmaceutical->avater = $this->uploadFile($request->file('avater'));
            }

            if ($request->hasFile('certificate')) {
                $pharmaceutical->certificate = $this->uploadFile($request->file('certificate'));
            }
            $isSave = $pharmaceutical->save();
            if ($isSave) {
                $role =  Role::findOrFail($request->get('role_id'));
                $pharmaceutical->assignRole($role);
            }
            return ControllersService::generateProcessResponse($isSave, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmaceutical $pharmaceutical)
    {
        $deleted = $pharmaceutical->delete();

        return response()->json([
            'status' => $deleted,
            'message' => Messages::getMessage('SUCCESS'),
        ], Response::HTTP_OK);
    }
}
