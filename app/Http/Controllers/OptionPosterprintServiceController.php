<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\OptionPostcardService;
use App\Models\OptionPosterprintService;
use App\Models\PosterprintService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionPosterprintServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OptionPosterprintService::all();
        return view('cms.poster.options.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poster = PosterprintService::where('active', true)->get();
        $currency = Currency::all();
        return view('cms.poster.options.create', ['poster' => $poster, 'currency' => $currency]);
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
            'posterprint_service_id' => 'required|string|exists:posterprint_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ]);
        if (!$validator->fails()) {

            $optionPosterprintService = new OptionPosterprintService();
            $optionPosterprintService->posterprint_service_id = $request->input('posterprint_service_id');
            $optionPosterprintService->title_ar = $request->input('title_ar');
            $optionPosterprintService->title_en = $request->input('title_en');
            $optionPosterprintService->active = $request->input('active');
            $optionPosterprintService->width = $request->input('width');
            $optionPosterprintService->height = $request->input('height');
            $optionPosterprintService->image = $this->uploadFile($request->file('image'), 'postprinting');
            $isSaved = $optionPosterprintService->save();

            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionPosterprintService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionPosterprintService  $optionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function show(OptionPosterprintService $optionPosterprintService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionPosterprintService  $optionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionPosterprintService $optionPosterprintService)
    {

        $currency = Currency::all();
        $poster = PosterprintService::where('active', true)->get();
        return view('cms.poster.options.edit', ['data' => $optionPosterprintService, 'poster' => $poster, 'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionPosterprintService  $optionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionPosterprintService $optionPosterprintService)
    {
        $validator = Validator($request->all(), [
            'posterprint_service_id' => 'required|string|exists:posterprint_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ]);
        if (!$validator->fails()) {

            $optionPosterprintService->posterprint_service_id = $request->input('posterprint_service_id');
            $optionPosterprintService->title_ar = $request->input('title_ar');
            $optionPosterprintService->title_en = $request->input('title_en');
            $optionPosterprintService->active = $request->input('active');
            $optionPosterprintService->width = $request->input('width');
            $optionPosterprintService->height = $request->input('height');
            if($request->hasFile('image')){
                $optionPosterprintService->image = $this->uploadFile($request->file('image'), 'postprinting');
            }
            $isSaved = $optionPosterprintService->save();

            // $optionPosterprintService->price()->delete();
            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionPosterprintService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
           
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionPosterprintService  $optionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionPosterprintService $optionPosterprintService)
    {
        // $optionPosterprintService->price()->delete();
        return $this->destroyTrait($optionPosterprintService);
    }
}
