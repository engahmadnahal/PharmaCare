<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\PosterprintService;
use App\Models\ServiceStudio;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PosterprintServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PosterprintService::all();
        return view('cms.poster.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = ServiceStudio::all();
        return view('cms.poster.create',[
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
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            // 'discount_value' => 'required|numeric',
            'tax' => 'required|numeric',
            'active' => 'required|boolean',
            'is_tax' => 'required|boolean',
            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'slider_images_4' => 'required|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'posterprint');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'posterprint');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'posterprint');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'posterprint');
                $slids['foure'] = $slid4;
            }
            $posterprintService = new PosterprintService();
            $posterprintService->service_studio_id = $request->input('service_studio_id');
            $posterprintService->title_ar = $request->input('title_ar');
            $posterprintService->title_en = $request->input('title_en');
            $posterprintService->about_ar = $request->input('about_ar');
            $posterprintService->about_en = $request->input('about_en');
            $posterprintService->tax = $request->input('tax');
            $posterprintService->is_tax = $request->input('is_tax');

            // $posterprintService->discount_value = $request->input('discount_value');

            $posterprintService->active = $request->input('active');
            $posterprintService->soon = $request->input('soon');
            $posterprintService->poster = $this->uploadFile($request->file('poster'),'postcard');
            $posterprintService->slider_images = json_encode($slids);
            $isSaved = $posterprintService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PosterprintService  $posterprintService
     * @return \Illuminate\Http\Response
     */
    public function show(PosterprintService $posterprintService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PosterprintService  $posterprintService
     * @return \Illuminate\Http\Response
     */
    public function edit(PosterprintService $posterprintService)
    {
        $objSlides = (object) json_decode($posterprintService->slider_images);
        $posterprintService->setAttribute('slides',$objSlides);
        $services = ServiceStudio::all();
        return view('cms.poster.edit',['data' => $posterprintService,
                'services' => $services
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PosterprintService  $posterprintService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosterprintService $posterprintService)
    {
        $validator = Validator($request->all(), [
            'service_studio_id' => 'required|numeric|exists:service_studios,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            // 'discount_value' => 'required|numeric',
            'tax' => 'required|numeric',
            'is_tax' => 'required|boolean',
            'active' => 'required|boolean',
            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($posterprintService->slider_images);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
                'foure' => $objSlides->foure,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'posterprint');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_2')){
                $slid2 = $this->uploadFile($request->file('slider_images_2'),'posterprint');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'posterprint');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'posterprint');
                $slids['foure'] = $slid4;
            }
            if($request->hasFile('poster')){
                $posterprintService->poster = $this->uploadFile($request->file('poster'),'posterprint');
            }
            $posterprintService->service_studio_id = $request->input('service_studio_id');
            $posterprintService->title_ar = $request->input('title_ar');
            $posterprintService->title_en = $request->input('title_en');
            $posterprintService->about_ar = $request->input('about_ar');
            $posterprintService->about_en = $request->input('about_en');
            $posterprintService->tax = $request->input('tax');
            // $posterprintService->discount_value = $request->input('discount_value');


            $posterprintService->is_tax = $request->input('is_tax');
            $posterprintService->active = $request->input('active');
            $posterprintService->soon = $request->input('soon');
            
            $posterprintService->slider_images = json_encode($slids);
            $isSaved = $posterprintService->save();

            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PosterprintService  $posterprintService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosterprintService $posterprintService)
    {
        return $this->destroyTrait($posterprintService);
    }
}
