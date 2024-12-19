<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\FrameAlbumService;
use App\Models\ServiceStudio;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrameAlbumServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FrameAlbumService::all();
        return view('cms.framealbum.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = ServiceStudio::all();
        return view('cms.framealbum.create',[
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
            'tax' => 'required|numeric',
            'about_en' => 'required|string',
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
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'framealbum');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'framealbum');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'framealbum');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'framealbum');
                $slids['foure'] = $slid4;
            }
            $frameAlbumService = new FrameAlbumService();
            $frameAlbumService->service_studio_id = $request->input('service_studio_id');
            $frameAlbumService->title_ar = $request->input('title_ar');
            $frameAlbumService->title_en = $request->input('title_en');
            $frameAlbumService->about_ar = $request->input('about_ar');
            $frameAlbumService->about_en = $request->input('about_en');
            $frameAlbumService->tax = $request->input('tax');
            $frameAlbumService->is_tax  = $request->input('is_tax');
            // $frameAlbumService->discount_value = $request->input('discount_value');
            $frameAlbumService->active = $request->input('active');
            $frameAlbumService->soon = $request->input('soon');
            $frameAlbumService->poster = $this->uploadFile($request->file('poster'),'framealbum');
            $frameAlbumService->slider_images = json_encode($slids);
            $isSaved = $frameAlbumService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrameAlbumService  $frameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function show(FrameAlbumService $frameAlbumService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrameAlbumService  $frameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function edit(FrameAlbumService $frameAlbumService)
    {

        $objSlides = (object) json_decode($frameAlbumService->slider_images);
        $frameAlbumService->setAttribute('slides',$objSlides);
        $services = ServiceStudio::all();
        return view('cms.framealbum.edit',['data' => $frameAlbumService,
                'services' => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrameAlbumService  $frameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrameAlbumService $frameAlbumService)
    {
        $validator = Validator($request->all(), [
            'service_studio_id' => 'required|numeric|exists:service_studios,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
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
            $objSlides = (object) json_decode($frameAlbumService->slider_images);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
                'foure' => $objSlides->foure,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'framealbum');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_2')){
                $slid2 = $this->uploadFile($request->file('slider_images_2'),'framealbum');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'framealbum');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'framealbum');
                $slids['foure'] = $slid4;
            }
          
            if($request->hasFile('poster')){
                $frameAlbumService->poster = $this->uploadFile($request->file('poster'),'framealbum');
            }
            $frameAlbumService->service_studio_id = $request->input('service_studio_id');
            $frameAlbumService->title_ar = $request->input('title_ar');
            $frameAlbumService->title_en = $request->input('title_en');
            $frameAlbumService->about_ar = $request->input('about_ar');
            $frameAlbumService->about_en = $request->input('about_en');
            $frameAlbumService->tax = $request->input('tax');
            $frameAlbumService->is_tax  = $request->input('is_tax');
            // $frameAlbumService->discount_value = $request->input('discount_value');
            $frameAlbumService->active = $request->input('active');
            $frameAlbumService->soon = $request->input('soon');
            if(count($slids) > 0){
                $frameAlbumService->slider_images = json_encode($slids);
            }

            $isSaved = $frameAlbumService->save();

            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrameAlbumService  $frameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrameAlbumService $frameAlbumService)
    {
        return $this->destroyTrait($frameAlbumService,['poster']);
    }
}
