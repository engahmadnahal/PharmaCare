<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\BookingStudioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingStudioServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BookingStudioService::all();
        return view('cms.bookingstudio.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.bookingstudio.create');
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
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'required|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
            'tax' => 'required|numeric',
            'is_tax' => 'required|boolean',

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
            $bookingStudioService = new BookingStudioService();
            $bookingStudioService->title_ar = $request->input('title_ar');
            $bookingStudioService->title_en = $request->input('title_en');
            $bookingStudioService->about_ar = $request->input('about_ar');
            $bookingStudioService->about_en = $request->input('about_en');
            $bookingStudioService->active = $request->input('active');
            $bookingStudioService->tax = $request->input('tax');
            $bookingStudioService->is_tax = $request->input('is_tax');
            $bookingStudioService->soon = $request->input('soon');
            $bookingStudioService->poster = $this->uploadFile($request->file('poster'),'softcopy');
            $bookingStudioService->slider_images = json_encode($slids);
            $isSaved = $bookingStudioService->save();

            return ControllersService::generateProcessResponse($isSaved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookingStudioService  $bookingStudioService
     * @return \Illuminate\Http\Response
     */
    public function show(BookingStudioService $bookingStudioService)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookingStudioService  $bookingStudioService
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingStudioService $bookingStudioService)
    {
        $objSlides = (object) json_decode($bookingStudioService->slider_images);
        $bookingStudioService->setAttribute('slides',$objSlides);
        return view('cms.bookingstudio.edit',['data' => $bookingStudioService]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookingStudioService  $bookingStudioService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingStudioService $bookingStudioService)
    {
        $validator = Validator($request->all(), [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'poster' => 'nullable|image|mimes:png,jpg',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'soon' => 'required|boolean',
            'active' => 'required|boolean',
            'tax' => 'required|numeric',
            'is_tax' => 'required|boolean',

            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($bookingStudioService->slider_images);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
                'foure' => $objSlides->foure,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'bookingstudio');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_2')){
                $slid2 = $this->uploadFile($request->file('slider_images_2'),'bookingstudio');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'bookingstudio');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'bookingstudio');
                $slids['foure'] = $slid4;
            }
          
            if($request->hasFile('poster')){
                $bookingStudioService->poster = $this->uploadFile($request->file('poster'),'bookingstudio');
            }
            $bookingStudioService->title_ar = $request->input('title_ar');
            $bookingStudioService->title_en = $request->input('title_en');
            $bookingStudioService->about_ar = $request->input('about_ar');
            $bookingStudioService->about_en = $request->input('about_en');
            $bookingStudioService->tax = $request->input('tax');
            $bookingStudioService->is_tax = $request->input('is_tax');
            $bookingStudioService->active = $request->input('active');
            $bookingStudioService->soon = $request->input('soon');
            if(count($slids) > 0){
                $bookingStudioService->slider_images = json_encode($slids);
            }
            $isSaved = $bookingStudioService->save();

            return ControllersService::generateProcessResponse($isSaved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookingStudioService  $bookingStudioService
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingStudioService $bookingStudioService)
    {
        return $this->destroyTrait($bookingStudioService,['poster']);
    }
}
