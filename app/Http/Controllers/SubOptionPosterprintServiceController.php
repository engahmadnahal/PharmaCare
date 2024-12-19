<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\OptionPosterprintService;
use App\Models\PackgePosterService;
use App\Models\SubOptionPosterprintService;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;

class SubOptionPosterprintServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubOptionPosterprintService::all();
        return view('cms.poster.suboptions.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $package = PackgePosterService::all();
        $currency = Currency::all();
        return view('cms.poster.suboptions.create', ['package' => $package, 'currency' => $currency]);
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
            'type' => 'required|string|in:print,frame,printColor',
            'image' => 'required|image|mimes:png,jpg',
            'packge_poster_service_id' => 'required|string|exists:packge_poster_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'price.*' => 'required|numeric',
            'isPrice' => 'required|boolean',
        ]);

        if (!$validator->fails()) {

            $subOptionPosterprintService = new SubOptionPosterprintService();
            $subOptionPosterprintService->packge_poster_service_id = $request->input('packge_poster_service_id');
            $subOptionPosterprintService->type = $request->input('type');
            $subOptionPosterprintService->description_en = $request->input('description_en');
            $subOptionPosterprintService->description_ar = $request->input('description_ar');
            $subOptionPosterprintService->isPrice = $request->input('isPrice');
            $subOptionPosterprintService->image = $this->uploadFile($request->file('image'), 'postprinting');
            $isSaved = $subOptionPosterprintService->save();

            if ($request->input('isPrice')) {

                foreach (json_decode($request->input('price')) as $price) {
                    $subOptionPosterprintService->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }
            }
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubOptionPosterprintService  $subOptionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function show(SubOptionPosterprintService $subOptionPosterprintService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubOptionPosterprintService  $subOptionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function edit(SubOptionPosterprintService $subOptionPosterprintService)
    {
        $currency = Currency::all();
        $optionPoster = OptionPosterprintService::where('active', true)->get();
        return view('cms.poster.suboptions.edit', ['data' => $subOptionPosterprintService, 'optionPoster' => $optionPoster, 'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubOptionPosterprintService  $subOptionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubOptionPosterprintService $subOptionPosterprintService)
    {
        $validator = Validator($request->all(), [
            'type' => 'required|string|in:print,frame,printColor',
            'image' => 'nullable|image|mimes:png,jpg',
            'packge_poster_service_id' => 'required|string|exists:packge_poster_services,id',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'price.*' => 'required|numeric',
            'isPrice' => 'required|boolean',
        ]);
        if (!$validator->fails()) {

            $subOptionPosterprintService->packge_poster_service_id = $request->input('packge_poster_service_id');
            $subOptionPosterprintService->type = $request->input('type');
            $subOptionPosterprintService->description_en = $request->input('description_en');
            $subOptionPosterprintService->description_ar = $request->input('description_ar');
            $subOptionPosterprintService->isPrice = $request->input('isPrice');
            if ($request->hasFile('image')) {
                $subOptionPosterprintService->image = $this->uploadFile($request->file('image'), 'postprinting');
            }
            $isSaved = $subOptionPosterprintService->save();

            if ($request->input('isPrice')) {

                $subOptionPosterprintService->price()->delete();
                foreach (json_decode($request->input('price')) as $price) {
                    $subOptionPosterprintService->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }
            }

            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubOptionPosterprintService  $subOptionPosterprintService
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubOptionPosterprintService $subOptionPosterprintService)
    {
        $subOptionPosterprintService->price()->delete();
        return $this->destroyTrait($subOptionPosterprintService, ['image']);
    }
}
