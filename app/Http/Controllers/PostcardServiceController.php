<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\PostcardService;
use App\Models\ServiceStudio;
use App\Models\StudioService;
use Illuminate\Http\Request;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class PostcardServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostcardService::all();
        return view('cms.postcard.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = ServiceStudio::all();
        return view('cms.postcard.create',[
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
            // 'discount_value' => 'required|numeric',
            'soon' => 'required|boolean',
            'tax' => 'required|numeric',
            'is_tax' => 'required|boolean',
            'active' => 'required|boolean',
            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'slider_images_4' => 'required|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'postcard');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'postcard');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'postcard');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'postcard');
                $slids['foure'] = $slid4;
            }
            $postcardService = new PostcardService;
            $postcardService->service_studio_id = $request->input('service_studio_id');
            $postcardService->title_ar = $request->input('title_ar');
            $postcardService->title_en = $request->input('title_en');
            // $postcardService->discount_value = $request->input('discount_value');
            $postcardService->about_ar = $request->input('about_ar');
            $postcardService->about_en = $request->input('about_en');
            $postcardService->active = $request->input('active');
            $postcardService->soon = $request->input('soon');
            $postcardService->is_tax = $request->input('is_tax');
            $postcardService->tax = $request->input('tax');
            $postcardService->poster = $this->uploadFile($request->file('poster'),'postcard');
            $postcardService->slider_images = json_encode($slids);
            $isSaved = $postcardService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostcardService  $postcardService
     * @return \Illuminate\Http\Response
     */
    public function show(PostcardService $postcardService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostcardService  $postcardService
     * @return \Illuminate\Http\Response
     */
    public function edit(PostcardService $postcardService)
    {
        $objSlides = (object) json_decode($postcardService->slider_images);
        $postcardService->setAttribute('slides',$objSlides);
        $services = ServiceStudio::all();
        return view('cms.postcard.edit',['data' => $postcardService,
            'services' => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostcardService  $postcardService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostcardService $postcardService)
    {
        $validator = Validator($request->all(), [
            'service_studio_id' => 'required|numeric|exists:service_studios,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            // 'discount_value' => 'required|numeric',
            'soon' => 'required|boolean',
            'tax' => 'required|numeric',
            'is_tax' => 'required|boolean',
            'active' => 'required|boolean',
            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',

        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($postcardService->slider_images);
            $newSlide = new stdClass;
            $slid1 = $objSlides->one;
            $slid2 = $objSlides->two;
            $slid3 = $objSlides->three;
            $slid4 = $objSlides->foure;

            if($request->hasFile('slider_images_1')){
                $newSlide->one = $this->uploadFile($request->file('slider_images_1'),'postcard');
            }else{
                $newSlide->one = $slid1;
            }

            if($request->hasFile('slider_images_2')){
                $newSlide->two = $this->uploadFile($request->file('slider_images_2'),'postcard');

            }else{
                $newSlide->two = $slid2;
            }

            if($request->hasFile('slider_images_3')){
                $newSlide->three = $this->uploadFile($request->file('slider_images_3'),'postcard');
            }else{
                $newSlide->three = $slid3;
            }

            if($request->hasFile('slider_images_4')){
                $newSlide->foure = $this->uploadFile($request->file('slider_images_4'),'postcard');
            }else{
                $newSlide->foure = $slid4;
            }

            if($request->hasFile('poster')){
                $postcardService->poster = $this->uploadFile($request->file('poster'),'postcard');
            }
        
            $postcardService->service_studio_id = $request->input('service_studio_id');
            $postcardService->title_ar = $request->input('title_ar');
            $postcardService->title_en = $request->input('title_en');
            // $postcardService->discount_value = $request->input('discount_value');
            $postcardService->about_ar = $request->input('about_ar');
            $postcardService->about_en = $request->input('about_en');
            $postcardService->active = $request->input('active');
            $postcardService->soon = $request->input('soon');
            $postcardService->is_tax = $request->input('is_tax');
            $postcardService->tax = $request->input('tax');
            $postcardService->slider_images = json_encode($newSlide);
            $isSaved = $postcardService->save();

            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostcardService  $postcardService
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostcardService $postcardService)
    {
        $postcardService->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
