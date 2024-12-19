<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Delivary;
use App\Models\Region;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DelivaryController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Delivary::all();
        return view('cms.delivary.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::where('active',true)->get();
        return view('cms.delivary.create',['regions' => $regions]);
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
            'name' => 'required|string',
            'mobile' => 'required|string|unique:delivaries,mobile',
            'address' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:delivaries,national_id',
            'region_id' => 'required|integer|exists:regions,id',
            'active' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $delivary = new Delivary();
            $delivary->name = $request->input('name');
            $delivary->mobile = $request->input('mobile');
            $delivary->address = $request->input('address');
            $delivary->avater = $this->uploadFile($request->file('avater'));
            $delivary->national_id = $request->input('national_id');
            $delivary->region_id = $request->input('region_id');
            $delivary->active = $request->input('active');
            $isSave = $delivary->save();
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivary  $delivary
     * @return \Illuminate\Http\Response
     */
    public function show(Delivary $delivary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivary  $delivary
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivary $delivary)
    {
        $regions = Region::where('active',true)->get();
        return view('cms.delivary.edit',['regions' => $regions,'delivary' => $delivary]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivary  $delivary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivary $delivary)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|string|unique:delivaries,mobile,'.$delivary->id,
            'address' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:delivaries,national_id,'.$delivary->id,
            'region_id' => 'required|integer|exists:regions,id',
            'active' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $delivary->name = $request->input('name');
            $delivary->mobile = $request->input('mobile');
            $delivary->address = $request->input('address');
            if($request->hasFile('avater')){
                $delivary->avater = $this->uploadFile($request->file('avater'));
            }
            $delivary->national_id = $request->input('national_id');
            $delivary->region_id = $request->input('region_id');
            $delivary->active = $request->input('active');
            $isSave = $delivary->save();
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivary  $delivary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivary $delivary)
    {
        $delivary->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
