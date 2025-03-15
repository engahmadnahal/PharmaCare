<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\MedicineType;
use Illuminate\Http\Request;

class MedicineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MedicineType::paginate(10);
        return view('cms.medicine-types.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.medicine-types.create');
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $medicineType = new MedicineType();
        $medicineType->name_ar = $request->name_ar;
        $medicineType->name_en = $request->name_en;
        $medicineType->status = $request->status;
        $isSaved = $medicineType->save();

        return ControllersService::generateProcessResponse($isSaved, 'CREATE');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineType $medicineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineType $medicineType)
    {
        return view('cms.medicine-types.edit', ['medicineType' => $medicineType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineType $medicineType)
    {
        $validator = Validator($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $medicineType->name_ar = $request->name_ar;
        $medicineType->name_en = $request->name_en;
        $medicineType->status = $request->status;
        $isSaved = $medicineType->save();

        return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineType $medicineType)
    {
        $isDeleted = $medicineType->delete();
        return ControllersService::generateProcessResponse($isDeleted, 'DELETE');
    }
}
