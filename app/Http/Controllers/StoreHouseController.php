<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Models\City;
use App\Models\StoreHouse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StoreHouse::all();
        return view('cms.storehouse.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('active',true)->get();
        return view('cms.storehouse.create',['cities' => $cities]);
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
            'active' => 'required|boolean',
            'city_id' => 'required|string|exists:cities,id',
        ]);
        if (!$validator->fails()) {
            $storeHouse = new StoreHouse();
            $storeHouse->name_ar = $request->input('name_ar');
            $storeHouse->name_en = $request->input('name_en');
            $storeHouse->active = $request->input('active');
            $storeHouse->city_id = $request->input('city_id');
            $storeHouse->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreHouse  $storeHouse
     * @return \Illuminate\Http\Response
     */
    public function show(StoreHouse $storeHouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreHouse  $storeHouse
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreHouse $storeHouse)
    {
        $cities = City::where('active',true)->get();
        return view('cms.storehouse.edit',['cities' => $cities,'storeHouse' => $storeHouse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreHouse  $storeHouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreHouse $storeHouse)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'active' => 'required|boolean',
            'city_id' => 'required|string|exists:cities,id',
        ]);
        if (!$validator->fails()) {
            $storeHouse->name_ar = $request->input('name_ar');
            $storeHouse->name_en = $request->input('name_en');
            $storeHouse->active = $request->input('active');
            $storeHouse->city_id = $request->input('city_id');
            $storeHouse->save();

            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreHouse  $storeHouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreHouse $storeHouse)
    {
        $storeHouse->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
