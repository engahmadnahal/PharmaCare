<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\City;
use App\Models\Country;
use App\Models\Pharmaceutical;
use App\Models\Region;
use Illuminate\Http\Request;
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
        $pharmaceuticals = Pharmaceutical::where('status', true)->get();
        return view('cms.pharma.create', ['pharmaceuticals' => $pharmaceuticals]);
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|unique:pharmaceuticals,email',
            'mobile' => 'required|string|unique:pharmaceuticals,mobile',
            'phone' => 'required|string|unique:pharmaceuticals,phone',
            'commercial_register' => 'required|file|mimes:pdf',
            'tax_number' => 'required|string',
            'type' => 'required|string',
            'has_branch' => 'required|boolean',
            'address' => 'required|string|max:255',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:pharmaceuticals,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

        $pharmaceutical = new Pharmaceutical();
        $pharmaceutical->name_en = $request->input('name_en');
        $pharmaceutical->name_ar = $request->input('name_ar');
        $pharmaceutical->email = $request->input('email');
        $pharmaceutical->mobile = $request->input('mobile');
        $pharmaceutical->phone = $request->input('phone');
        $pharmaceutical->commercial_register = $this->uploadFile($request->file('commercial_register'), 'commercial_register');
        $pharmaceutical->tax_number = $request->input('tax_number');
        $pharmaceutical->type = $request->input('type');
        $pharmaceutical->has_branch = $request->input('has_branch');
        $pharmaceutical->address = $request->input('address');
        $pharmaceutical->status = $request->input('status');
        $pharmaceutical->parent_id = $request->input('parent_id');

        $isSave = $pharmaceutical->save();
        return ControllersService::generateProcessResponse($isSave, 'CREATE');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmaceutical $pharmaceutical)
    {

        return view('cms.pharma.show', ['pharmaceutical' => $pharmaceutical]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmaceutical  $pharmaceutical
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmaceutical $pharmaceutical)
    {
        $pharmaceuticals = Pharmaceutical::where('status', true)->get();

        return view('cms.pharma.edit', ['pharmaceutical' => $pharmaceutical, 'pharmaceuticals' => $pharmaceuticals]);
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|unique:pharmaceuticals,email,' . $pharmaceutical->id,
            'mobile' => 'required|string|unique:pharmaceuticals,mobile,' . $pharmaceutical->id,
            'phone' => 'required|string|unique:pharmaceuticals,phone,' . $pharmaceutical->id,
            'commercial_register' => 'nullable|file|mimes:pdf',
            'tax_number' => 'required|string',
            'type' => 'required|string',
            'has_branch' => 'required|boolean',
            'address' => 'required|string|max:255',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:pharmaceuticals,id'
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $pharmaceutical->name_en = $request->input('name_en');
        $pharmaceutical->name_ar = $request->input('name_ar');
        $pharmaceutical->email = $request->input('email');
        $pharmaceutical->mobile = $request->input('mobile');
        $pharmaceutical->phone = $request->input('phone');
        if ($request->hasFile('commercial_register')) {
            $pharmaceutical->commercial_register = $this->uploadFile($request->file('commercial_register'), 'commercial_register');
        }
        $pharmaceutical->tax_number = $request->input('tax_number');
        $pharmaceutical->type = $request->input('type');
        $pharmaceutical->has_branch = $request->input('has_branch');
        $pharmaceutical->address = $request->input('address');
        $pharmaceutical->status = $request->input('status');
        $pharmaceutical->parent_id = $request->input('parent_id');

        $isSave = $pharmaceutical->save();
        return ControllersService::generateProcessResponse($isSave, 'UPDATE');
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
        return ControllersService::generateProcessResponse($deleted, 'DELETE');
    }
}
