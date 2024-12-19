<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Country;
use App\Models\Currency;
use App\Models\PassportCountry;
use App\Models\PassportOption;
use App\Models\PassportService;
use App\Models\PassportType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;

class PassportOptionController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = PassportOption::all();
        return view('cms.passport.options.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $passportType = PassportType::where('active', true)->get();
        $passport = PassportService::where('active', true)->get();
        $countries = PassportCountry::where('active', true)->get();
        $currency = Currency::all();
        return view('cms.passport.options.create', ['passport' => $passport, 'passportType' => $passportType, 'countries' => $countries, 'currency' => $currency]);
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
            // 'discount_value' => 'required|integer',
            'country_id' => 'required|numeric|exists:passport_countries,id',
            'type' => 'required|numeric|exists:passport_types,id',
            'passport_service_id' => 'required|numeric|exists:passport_services,id',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'note' => 'nullable|string',
            'note_en' => 'nullable|string',
            'isNote' => 'required|boolean',
            'num_photo' => 'required|numeric',
            'num_add' => 'required|numeric',
            'photo_price.*.value' => 'required|numeric',
            'photo_price.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.value' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG',
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        if (!$validator->fails()) {

            $isSaved = DB::transaction(function () use ($request) {

                $passportOption = new PassportOption();
                $passportOption->discount_value = 0;
                $passportOption->passport_type_id = $request->input('type');
                $passportOption->passport_service_id = $request->input('passport_service_id');
                $passportOption->image = $this->uploadFile($request->file('image'));
                $passportOption->num_add = $request->input('num_add');
                $passportOption->passport_country_id = $request->input('country_id');
                $passportOption->title_ar = $request->input('title_ar');
                $passportOption->title_en = $request->input('title_en');
                $passportOption->isNote = $request->input('isNote');
                $passportOption->note = $request->input('note');
                $passportOption->note_en = $request->input('note_en');
                $passportOption->description_ar = $request->input('description_ar');
                $passportOption->description_en = $request->input('description_en');
                $passportOption->num_photo = $request->input('num_photo');
                $passportOption->min_size_image = $request->input('min_size_image');
                $passportOption->type_size = $request->input('type_size');
                $isSaved = $passportOption->save();

                try {
                    foreach ($request->input('photo_price') as $price) {
                        $price = (object) $price;
                        $passportOption->price()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                } catch (Exception $e) {
                    return false;
                    // return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
                }

                // Add In Table 
                try {
                    
                    foreach ($request->input('price_after_increse') as $price) {
                        $price = (object) $price;
                        $passportOption->priceAfterIncres()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                    // }
                } catch (Exception $e) {
                    return false;
                    // return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
                }

                return $isSaved;
            });

            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PassportService  $passportOption
     * @return \Illuminate\Http\Response
     */
    public function show(PassportOption $passportOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PassportService  $passportOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PassportOption $passportOption)
    {

        $passportType = PassportType::where('active', true)->get();
        $passport = PassportService::where('active', true)->get();
        $countries = PassportCountry::where('active', true)->get();
        $currency = Currency::all();
        return view('cms.passport.options.edit', ['passport' => $passport, 'currency' => $currency, 'data' => $passportOption, 'passportType' => $passportType, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PassportService  $passportOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassportOption $passportOption)
    {

        // $pricePhoto = json_decode($request->photo_price);
        // $priceIncres = json_decode($request->price_after_increse);
        // $request->merge([
        //     'photo_price' => $pricePhoto,
        //     'price_after_increse' => $priceIncres,
        // ]);

        $validator = Validator($request->all(), [
            // 'discount_value' => 'required|integer',
            'country_id' => 'required|numeric|exists:passport_countries,id',
            'type' => 'required|numeric|exists:passport_types,id',
            'passport_service_id' => 'required|numeric|exists:passport_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'note' => 'nullable|string',
            'note_en' => 'nullable|string',
            'isNote' => 'required|boolean',
            'num_photo' => 'required|numeric',
            // 'price_elm' => 'required|integer',
            'num_add' => 'required|numeric',
            'photo_price.*.value' => 'required|numeric',
            'photo_price.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.value' => 'required|numeric',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'

        ]);
        if (!$validator->fails()) {

            $isSaved = DB::transaction(function () use ($request, $passportOption) {

                if($request->hasFile('image')){
                    $passportOption->image = $this->uploadFile($request->file('image'));
                }

                $passportOption->discount_value = 0;
                $passportOption->passport_type_id = $request->input('type');
                $passportOption->passport_service_id = $request->input('passport_service_id');
                $passportOption->num_add = $request->input('num_add');
                $passportOption->passport_country_id = $request->input('country_id');
                $passportOption->title_ar = $request->input('title_ar');
                $passportOption->title_en = $request->input('title_en');
                $passportOption->isNote = $request->input('isNote');
                $passportOption->note = $request->input('note');
                $passportOption->note_en = $request->input('note_en');
                $passportOption->description_ar = $request->input('description_ar');
                $passportOption->description_en = $request->input('description_en');
                $passportOption->num_photo = $request->input('num_photo');
                $passportOption->min_size_image = $request->input('min_size_image');
                $passportOption->type_size = $request->input('type_size');
                $isSaved = $passportOption->save();

                if ($passportOption->price()->delete() || $passportOption->price->count() == 0) {
                    foreach ($request->photo_price as $price) {
                        $price = (object) $price;
                        $passportOption->price()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }
                try {
                } catch (Exception $e) {
                    return false;
                    // return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
                }
                // Add In Table 
                try {
                    if ($passportOption->priceAfterIncres()->delete() || $passportOption->priceAfterIncres->count() == 0) {
                        foreach ($request->input('price_after_increse') as $price) {
                            $price = (object) $price;
                            $passportOption->priceAfterIncres()->create([
                                'currency_id' => $price->currncyId,
                                'price' => $price->value
                            ]);
                        }
                    }
                } catch (Exception $e) {
                    return false;
                }

                return $isSaved;
            });
            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PassportService  $passportOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassportOption $passportOption)
    {
        return $this->destroyTrait($passportOption);
    }
}
