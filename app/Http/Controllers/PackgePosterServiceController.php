<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\OptionPostcardService;
use App\Models\OptionPosterprintService;
use App\Models\PackgePosterService;
use App\Models\PosterprintService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackgePosterServiceController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PackgePosterService::all();
        return view('cms.poster.packge.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionPoster = OptionPosterprintService::all();
        $currency = Currency::all();
        return view('cms.poster.packge.create',['optionPoster' => $optionPoster,'currency' => $currency]);
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
            'image' => 'required|image|mimes:png,jpg',
            'option_posterprint_service_id' => 'required|string|exists:option_posterprint_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'discount_value' => 'required|integer',
            'num_item_over' => 'required|integer',
            'min_item' => 'required|integer',
            'price.*' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG'
        ]);
        if (!$validator->fails()) {
            
            $packgePosterService = new PackgePosterService();
            $packgePosterService->option_posterprint_service_id = $request->input('option_posterprint_service_id');
            $packgePosterService->description_en = $request->input('description_en');
            $packgePosterService->description_ar = $request->input('description_ar');
            $packgePosterService->num_item_over = $request->input('num_item_over');
            $packgePosterService->min_item = $request->input('min_item');
            $packgePosterService->discount_value = $request->input('discount_value');
            $packgePosterService->min_size_image = $request->input('min_size_image');
            $packgePosterService->type_size = $request->input('type_size');
            $packgePosterService->image = $this->uploadFile($request->file('image'),'postprinting');
            $isSaved = $packgePosterService->save();

            try{
            foreach(json_decode($request->input('price')) as $price){
                $packgePosterService->price()->create([
                    'currency_id' => $price->currncyId,
                    'price' => $price->value
                ]);
            }
        }catch(Exception $e){
            return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
        }
            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackgePosterService  $packgePosterService
     * @return \Illuminate\Http\Response
     */
    public function show(PackgePosterService $packgePosterService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackgePosterService  $packgePosterService
     * @return \Illuminate\Http\Response
     */
    public function edit(PackgePosterService $packgePosterService)
    {
        $optionPoster = OptionPosterprintService::all();
        $currency = Currency::all();
        return view('cms.poster.packge.edit',['optionPoster' => $optionPoster,'data' => $packgePosterService,'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackgePosterService  $packgePosterService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackgePosterService $packgePosterService)
    {

        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'option_posterprint_service_id' => 'required|string|exists:option_posterprint_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'discount_value' => 'required|integer',
            'min_item' => 'required|integer',
            'num_item_over' => 'required|numeric',
            'price.*' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG'
        ]);

        if (!$validator->fails()) {
            $packgePosterService->option_posterprint_service_id = $request->input('option_posterprint_service_id');
            $packgePosterService->description_en = $request->input('description_en');
            $packgePosterService->description_ar = $request->input('description_ar');
            $packgePosterService->discount_value = $request->input('discount_value');
            $packgePosterService->num_item_over = $request->input('num_item_over');
            $packgePosterService->min_item = $request->input('min_item');
            $packgePosterService->min_size_image = $request->input('min_size_image');
            $packgePosterService->type_size = $request->input('type_size');
            if($request->hasFile('image')){
                $packgePosterService->image = $this->uploadFile($request->file('image'),'postprinting');
            }
            $isSaved = $packgePosterService->save();

            try{
            $packgePosterService->price()->delete();
            foreach(json_decode($request->input('price')) as $price){
                $packgePosterService->price()->create([
                    'currency_id' => $price->currncyId,
                    'price' => $price->value
                ]);
            }
        }catch(Exception $e){
            return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
        }
            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\packgePosterService  $packgePosterService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackgePosterService $packgePosterService)
    {
        $packgePosterService->price()->delete();
        return $this->destroyTrait($packgePosterService);
    }

}
