<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\OptionPostcardService;
use App\Models\PostcardService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionPostcardServiceController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OptionPostcardService::all();
        return view('cms.postcard.options.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $postcards = PostcardService::all();
        $currency = Currency::all();
        return view('cms.postcard.options.create',['postcards' => $postcards,'currency' => $currency]);

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
            'postcard_id' => 'required|string|exists:postcard_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $optionPostcardService = new OptionPostcardService();
            $optionPostcardService->postcard_service_id = $request->input('postcard_id');
            $optionPostcardService->title_ar = $request->input('title_ar');
            $optionPostcardService->title_en = $request->input('title_en');
            $optionPostcardService->active = $request->input('active');
            $optionPostcardService->width = $request->input('width');
            $optionPostcardService->height = $request->input('height');
            $optionPostcardService->image = $this->uploadFile($request->file('image'),'posterprint');
            $isSaved = $optionPostcardService->save();

            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionPostcardService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionPostcardService  $optionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function show(OptionPostcardService $optionPostcardService)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionPostcardService  $optionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionPostcardService $optionPostcardService)
    {
        $currency = Currency::all();
        $postcards = PostcardService::all();
        return view('cms.postcard.options.edit',['data' => $optionPostcardService,'postcards' => $postcards,'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionPostcardService  $optionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionPostcardService $optionPostcardService)
    {
        $validator = Validator($request->all(), [
            'postcard_id' => 'required|string|exists:postcard_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
   
        ]);
        if (!$validator->fails()) {
            $optionPostcardService->postcard_service_id = $request->input('postcard_id');
            $optionPostcardService->title_ar = $request->input('title_ar');
            $optionPostcardService->title_en = $request->input('title_en');
            $optionPostcardService->active = $request->input('active');
            $optionPostcardService->width = $request->input('width');
            $optionPostcardService->height = $request->input('height');
            if($request->hasFile('image')){
                $optionPostcardService->image = $this->uploadFile($request->file('image'),'posterprint');
            }
            $isSaved = $optionPostcardService->save();

            // $optionPostcardService->price()->delete();
            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionPostcardService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionPostcardService  $optionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionPostcardService $optionPostcardService)
    {
        $optionPostcardService->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
