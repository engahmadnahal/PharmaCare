<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\SoftCopyService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoftCopyServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SoftCopyService::all();
        return view('cms.softcopy.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cms.softcopy.create');

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
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'required|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
            'is_tax' => 'required|boolean',
            'tax' => 'required|numeric',

            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'slider_images_4' => 'required|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'softcopy');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'softcopy');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'softcopy');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'softcopy');
                $slids['foure'] = $slid4;
            }
            $softCopyService = new SoftCopyService();
            $softCopyService->title_ar = $request->input('title_ar');
            $softCopyService->title_en = $request->input('title_en');
            $softCopyService->about_ar = $request->input('about_ar');
            $softCopyService->about_en = $request->input('about_en');
            $softCopyService->active = $request->input('active');
            $softCopyService->soon = $request->input('soon');
            $softCopyService->is_tax = $request->input('is_tax');
            $softCopyService->tax = $request->input('tax');
            $softCopyService->poster = $this->uploadFile($request->file('poster'),'postcard');
            $softCopyService->slider_images = json_encode($slids);
            $isSaved = $softCopyService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoftCopyService  $softCopyService
     * @return \Illuminate\Http\Response
     */
    public function show(SoftCopyService $softCopyService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoftCopyService  $softCopyService
     * @return \Illuminate\Http\Response
     */
    public function edit(SoftCopyService $softCopyService)
    {
        //
        $objSlides = (object) json_decode($softCopyService->slider_images);
        $softCopyService->setAttribute('slides',$objSlides);
        return view('cms.softcopy.edit',['data' => $softCopyService]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SoftCopyService  $softCopyService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoftCopyService $softCopyService)
    {
        //
        $validator = Validator($request->all(), [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
            'is_tax' => 'required|boolean',
            'tax' => 'required|numeric',

            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($softCopyService->slider_images);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
                'foure' => $objSlides->foure,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'softcopy');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_2')){
                $slid2 = $this->uploadFile($request->file('slider_images_2'),'softcopy');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'softcopy');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'softcopy');
                $slids['foure'] = $slid4;
            }
          
            if($request->hasFile('poster')){
                $softCopyService->poster = $this->uploadFile($request->file('poster'),'softcopy');
            }
            $softCopyService->title_ar = $request->input('title_ar');
            $softCopyService->title_en = $request->input('title_en');
            $softCopyService->about_ar = $request->input('about_ar');
            $softCopyService->about_en = $request->input('about_en');
            $softCopyService->active = $request->input('active');
            $softCopyService->soon = $request->input('soon');
            $softCopyService->tax = $request->input('tax');
            $softCopyService->is_tax = $request->input('is_tax');

            if(count($slids) > 0){
                $softCopyService->slider_images = json_encode($slids);
            }
            $isSaved = $softCopyService->save();

            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoftCopyService  $softCopyService
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoftCopyService $softCopyService)
    {
        return $this->destroyTrait($softCopyService,['poster']);

    }
}
