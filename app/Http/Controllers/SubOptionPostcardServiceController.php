<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\OptionPostcardService;
use App\Models\SubOptionPostcardService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubOptionPostcardServiceController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubOptionPostcardService::all();
        return view('cms.postcard.suboptions.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionPostcards = OptionPostcardService::all();
        $currency = Currency::all();
        return view('cms.postcard.suboptions.create', ['optionPostcards' => $optionPostcards, 'currency' => $currency]);
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
            'option_postcard_service_id' => 'required|string|exists:option_postcard_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'discount_value' => 'required|integer',
            'min_item' => 'required|integer',
            'num_item_over' => 'required|integer',
            'price.*' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG'

        ]);
        if (!$validator->fails()) {

            $subOptionPostcardService = new SubOptionPostcardService();
            $subOptionPostcardService->option_postcard_service_id = $request->input('option_postcard_service_id');
            $subOptionPostcardService->discount_value = $request->input('discount_value');
            $subOptionPostcardService->description_en = $request->input('description_en');
            $subOptionPostcardService->description_ar = $request->input('description_ar');
            $subOptionPostcardService->min_item = $request->input('min_item');
            $subOptionPostcardService->num_item_over = $request->input('num_item_over');
            $subOptionPostcardService->min_size_image = $request->input('min_size_image');
            $subOptionPostcardService->type_size = $request->input('type_size');

            $subOptionPostcardService->image = $this->uploadFile($request->file('image'), 'postcard');
            $isSaved = $subOptionPostcardService->save();
            try {
                foreach (json_decode($request->input('price')) as $price) {
                    $subOptionPostcardService->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }
            } catch (Exception $e) {
                return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
            }
            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubOptionPostcardService  $subOptionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function show(SubOptionPostcardService $subOptionPostcardService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubOptionPostcardService  $subOptionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function edit(SubOptionPostcardService $subOptionPostcardService)
    {
        $optionPostcards = OptionPostcardService::all();
        $currency = Currency::all();
        return view('cms.postcard.suboptions.edit', ['optionPostcards' => $optionPostcards, 'data' => $subOptionPostcardService, 'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubOptionPostcardService  $subOptionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubOptionPostcardService $subOptionPostcardService)
    {

        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'option_postcard_service_id' => 'required|string|exists:option_postcard_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'num_item_over' => 'required|integer',
            'min_item' => 'required|integer',
            'discount_value' => 'required|integer',
            'price.*' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG'

        ]);

        if (!$validator->fails()) {
            $subOptionPostcardService->option_postcard_service_id = $request->input('option_postcard_service_id');
            $subOptionPostcardService->discount_value = $request->input('discount_value');
            $subOptionPostcardService->description_en = $request->input('description_en');
            $subOptionPostcardService->description_ar = $request->input('description_ar');
            $subOptionPostcardService->num_item_over = $request->input('num_item_over');
            $subOptionPostcardService->min_item = $request->input('min_item');
            $subOptionPostcardService->min_size_image = $request->input('min_size_image');
            $subOptionPostcardService->type_size = $request->input('type_size');
            if ($request->hasFile('image')) {
                $subOptionPostcardService->image = $this->uploadFile($request->file('image'), 'postcard');
            }
            $isSaved = $subOptionPostcardService->save();

            try {
                $subOptionPostcardService->price()->delete();
                foreach (json_decode($request->input('price')) as $price) {
                    $subOptionPostcardService->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }
            } catch (Exception $e) {
                return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
            }
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubOptionPostcardService  $subOptionPostcardService
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubOptionPostcardService $subOptionPostcardService)
    {
        $subOptionPostcardService->price()->delete();
        return $this->destroyTrait($subOptionPostcardService);
    }
}
