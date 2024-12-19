<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\FrameAlbumService;
use App\Models\OptionFrameAlbumService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionFrameAlbumServiceController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = OptionFrameAlbumService::all();
        return view('cms.framealbum.options.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $frame = FrameAlbumService::where('active',true)->get();
        $currency = Currency::all();
        return view('cms.framealbum.options.create',['frame' => $frame,'currency' => $currency]);
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
            'frame_album_service_id' => 'required|string|exists:frame_album_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'type' => 'required|string|in:frame,album',
        ]);
        if (!$validator->fails()) {
            

            $optionFrameAlbumService = new OptionFrameAlbumService();
            $optionFrameAlbumService->type = $request->input('type');

            $optionFrameAlbumService->frame_album_service_id = $request->input('frame_album_service_id');
            $optionFrameAlbumService->title_ar = $request->input('title_ar');
            $optionFrameAlbumService->title_en = $request->input('title_en');
            $optionFrameAlbumService->active = $request->input('active');
            $optionFrameAlbumService->image = $this->uploadFile($request->file('image'), 'frame');
            $isSaved = $optionFrameAlbumService->save();

            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionFrameAlbumService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionFrameAlbumService  $optionFrameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function show(OptionFrameAlbumService $optionFrameAlbumService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionFrameAlbumService  $optionFrameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionFrameAlbumService $optionFrameAlbumService)
    {
        $currency = Currency::all();
        $frame = FrameAlbumService::where('active',true)->get();
        return view('cms.framealbum.options.edit',['data' => $optionFrameAlbumService,'frame' => $frame,'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionFrameAlbumService  $optionFrameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionFrameAlbumService $optionFrameAlbumService)
    {
        
        $validator = Validator($request->all(), [
            'frame_album_service_id' => 'required|string|exists:frame_album_services,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            // 'price.*' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg',
            'active' => 'required|boolean',
            'type' => 'required|string|in:frame,album',
        ]);
        if (!$validator->fails()) {
            $optionFrameAlbumService->type = $request->input('type');
            $optionFrameAlbumService->frame_album_service_id = $request->input('frame_album_service_id');
            $optionFrameAlbumService->title_ar = $request->input('title_ar');
            $optionFrameAlbumService->title_en = $request->input('title_en');
            $optionFrameAlbumService->active = $request->input('active');
            if($request->hasFile('image')){

                $optionFrameAlbumService->image = $this->uploadFile($request->file('image'), 'frame');
            }
            $isSaved = $optionFrameAlbumService->save();

            // $optionFrameAlbumService->price()->delete();
            // foreach (json_decode($request->input('price')) as $price) {
            //     $optionFrameAlbumService->price()->create([
            //         'currency_id' => $price->currncyId,
            //         'price' => $price->value
            //     ]);
            // }
            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionFrameAlbumService  $optionFrameAlbumService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionFrameAlbumService $optionFrameAlbumService)
    {
        // $optionFrameAlbumService->price()->delete();
        return $this->destroyTrait($optionFrameAlbumService,['image']);
    }
}
