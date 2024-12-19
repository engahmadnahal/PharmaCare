<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\FramesOrAlbum;
use App\Models\OptionFrameAlbumService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FramesOrAlbumController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FramesOrAlbum::all();
        return view('cms.framealbum.suboptions.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Currency::all();
        $optionFrame = OptionFrameAlbumService::all();
        return view('cms.framealbum.suboptions.create',['optionFrame' => $optionFrame,'currency' => $currency]);

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
            'discount_value' => 'required|integer',
            'option_frame_album_service_id' => 'required|string|exists:option_frame_album_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'note_ar' => 'required|string',
            'note_en' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'num_photo' => 'required|numeric',
            // 'price.*' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'type' => 'required|string|in:frame,album',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG',
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


            $framesOrAlbum = new FramesOrAlbum();
            
            $framesOrAlbum->slider_image = json_encode($slids);
            $framesOrAlbum->discount_value = $request->input('discount_value');
            $framesOrAlbum->option_frame_album_service_id = $request->input('option_frame_album_service_id');
            $framesOrAlbum->title_ar = $request->input('title_ar');
            $framesOrAlbum->title_en = $request->input('title_en');
            $framesOrAlbum->note_ar = $request->input('note_ar');
            $framesOrAlbum->note_en = $request->input('note_en');
            $framesOrAlbum->description_ar = $request->input('description_ar');
            $framesOrAlbum->description_en = $request->input('description_en');
            $framesOrAlbum->type = $request->input('type');
            $framesOrAlbum->min_size_image = $request->input('min_size_image');
            $framesOrAlbum->type_size = $request->input('type_size');
            $framesOrAlbum->image = $this->uploadFile($request->file('image'), 'frame');
            $framesOrAlbum->num_photo = $request->input('num_photo');
            $isSaved = $framesOrAlbum->save();

            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FramesOrAlbum  $framesOrAlbum
     * @return \Illuminate\Http\Response
     */
    public function show(FramesOrAlbum $framesOrAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FramesOrAlbum  $framesOrAlbum
     * @return \Illuminate\Http\Response
     */
    public function edit(FramesOrAlbum $framesOrAlbum)
    {
        $optionFrame = OptionFrameAlbumService::all();
        $currency = Currency::all();
        $objSlides = (object) json_decode($framesOrAlbum->slider_image);
        $framesOrAlbum->setAttribute('slides',$objSlides);

        return view('cms.framealbum.suboptions.edit',['currency' => $currency,'optionFrame' => $optionFrame,'data' => $framesOrAlbum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FramesOrAlbum  $framesOrAlbum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FramesOrAlbum $framesOrAlbum)
    {
        $validator = Validator($request->all(), [
            'discount_value' => 'required|integer',
            'option_frame_album_service_id' => 'required|string|exists:option_frame_album_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'note_ar' => 'required|string',
            'note_en' => 'required|string',
            'num_photo' => 'required|numeric',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg',
            'type' => 'required|string|in:frame,album',
            'min_size_image' => 'required|integer',
            'type_size' => 'required|string|in:KB,MG',
            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $objSlides = (object) json_decode($framesOrAlbum->slider_image);
            $slids = [
                'one' => $objSlides->one,
                'two' => $objSlides->two,
                'three' => $objSlides->three,
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'postcard');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_3')){
                $slid2 = $this->uploadFile($request->file('slider_images_3'),'postcard');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'postcard');
                $slids['three'] = $slid3;
            }

            if(count($slids) > 0){
                $framesOrAlbum->slider_image = json_encode($slids);
            }

            $framesOrAlbum->discount_value = $request->input('discount_value');
            $framesOrAlbum->option_frame_album_service_id = $request->input('option_frame_album_service_id');
            $framesOrAlbum->title_ar = $request->input('title_ar');
            $framesOrAlbum->title_en = $request->input('title_en');
            $framesOrAlbum->note_ar = $request->input('note_ar');
            $framesOrAlbum->note_en = $request->input('note_en');
            $framesOrAlbum->description_ar = $request->input('description_ar');
            $framesOrAlbum->description_en = $request->input('description_en');
            $framesOrAlbum->min_size_image = $request->input('min_size_image');
            $framesOrAlbum->type_size = $request->input('type_size');
            $framesOrAlbum->type = $request->input('type');
            if($request->hasFile('image')){
                $framesOrAlbum->image = $this->uploadFile($request->file('image'), 'frame');
            }
            $framesOrAlbum->num_photo = $request->input('num_photo');
            $isSaved = $framesOrAlbum->save();


        //     try{
        //     $framesOrAlbum->price()->delete();
        //     foreach (json_decode($request->input('price')) as $price) {
        //         $framesOrAlbum->price()->create([
        //             'currency_id' => $price->currncyId,
        //             'price' => $price->value
        //         ]);
        //     }
        // }catch(Exception $e){
        //     return ControllersService::generateValidationErrorMessage(__('cms.error_price'));
        // }
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FramesOrAlbum  $framesOrAlbum
     * @return \Illuminate\Http\Response
     */
    public function destroy(FramesOrAlbum $framesOrAlbum)
    {
        // $framesOrAlbum->price()->delete();
        return $this->destroyTrait($framesOrAlbum,['image']);
    }
}
