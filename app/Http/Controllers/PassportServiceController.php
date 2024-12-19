<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Country;
use App\Models\Currency;
use App\Models\PassportService;
use App\Models\PassportType;
use App\Models\ServiceStudio;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PassportServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = PassportService::all();
        return view('cms.passport.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = ServiceStudio::all();
        return view('cms.passport.create',[
            'services' => $services
        ]);
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
            'service_studio_id' => 'required|numeric|exists:service_studios,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'required|image|mimes:png,jpg',
            // 'note' => 'nullable|string',
            // 'isNote' => 'required|boolean',
            'tax' => 'required|numeric',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
                        'is_tax' => 'required|boolean',
            // 'discount_value' => 'required|numeric',
            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'slider_images_4' => 'required|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'passport');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'passport');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'passport');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'passport');
                $slids['foure'] = $slid4;
            }
            $passportService = new PassportService();
            $passportService->service_studio_id = $request->input('service_studio_id');
            $passportService->title_ar = $request->input('title_ar');
            $passportService->title_en = $request->input('title_en');
            $passportService->active = $request->input('active');
            $passportService->soon = $request->input('soon');
            $passportService->tax = $request->input('tax');
            $passportService->is_tax  = $request->input('is_tax');
            // $passportService->discount_value = $request->input('discount_value');
            // $passportService->isNote = $request->input('isNote');
            // $passportService->note = $request->input('note');
            $passportService->poster = $this->uploadFile($request->file('poster'),'passport');
            $passportService->slider_images = json_encode($slids);
            $isSaved = $passportService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PassportService  $passportService
     * @return \Illuminate\Http\Response
     */
    public function show(PassportService $passportService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PassportService  $passportService
     * @return \Illuminate\Http\Response
     */
    public function edit(PassportService $passportService)
    {

        $objSlides = (object) json_decode($passportService->slider_images);
        $services = ServiceStudio::all();
        $passportService->setAttribute('slides',$objSlides);
        return view('cms.passport.edit',['data' => $passportService,
        'services' => $services
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PassportService  $passportService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PassportService $passportService)
    {
        $validator = Validator($request->all(), [
            'service_studio_id' => 'required|numeric|exists:service_studios,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            // 'note' => 'nullable|string',
            // 'isNote' => 'required|boolean',
            'tax' => 'required|numeric',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
                        'is_tax' => 'required|boolean',
            // 'discount_value' => 'required|numeric',
            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($passportService->slider_images);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
                'foure' => $objSlides->foure,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'passport');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_2')){
                $slid2 = $this->uploadFile($request->file('slider_images_2'),'passport');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'passport');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'passport');
                $slids['foure'] = $slid4;
            }
            if($request->hasFile('poster')){
                $passportService->poster = $this->uploadFile($request->file('poster'),'passport');
            }

            $passportService->service_studio_id = $request->input('service_studio_id');
            $passportService->title_ar = $request->input('title_ar');
            $passportService->title_en = $request->input('title_en');
            $passportService->active = $request->input('active');
            $passportService->soon = $request->input('soon');
                        $passportService->tax  = $request->input('tax');
                        $passportService->is_tax  = $request->input('is_tax');
            // $passportService->isNote = $request->input('isNote');
            // $passportService->note = $request->input('note');
            // $passportService->discount_value = $request->input('discount_value');
            $passportService->slider_images = json_encode($slids);
            $isSaved = $passportService->save();


            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PassportService  $passportService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PassportService $passportService)
    {
        return $this->destroyTrait($passportService,['poster']);
    }
}
