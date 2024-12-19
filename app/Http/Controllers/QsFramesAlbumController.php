<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\FramesOrAlbum;
use App\Models\QsFramesAlbum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QsFramesAlbumController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = QsFramesAlbum::all();
        return view('cms.framealbum.qs.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frameOrAlbum = FramesOrAlbum::whereDoesntHave('qs')->get();
        $currency = Currency::all();
        return view('cms.framealbum.qs.create',['frameOrAlbum' => $frameOrAlbum,'currency' => $currency]);
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
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'type' => 'required|string|in:yesOrNo',
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            // 'price.*' => 'required|numeric',
            // 'price.*.value' => 'required|numeric',
            // 'price.*.currncyId' => 'required|numeric|exists:currencies,id',
        ]);
        if (!$validator->fails()) {
            $exists = QsFramesAlbum::where('frames_or_album_id',$request->frames_or_album_id)->exists();
            if($exists){
                return ControllersService::generateValidationErrorMessage(__('cms.exists_qs'));
            }
            $qsFramesAlbum = new QsFramesAlbum;
            $qsFramesAlbum->frames_or_album_id = $request->input('frames_or_album_id');
            $qsFramesAlbum->qs_ar = $request->input('qs_ar');
            $qsFramesAlbum->qs_en = $request->input('qs_en');
            $qsFramesAlbum->type = $request->input('type');
            $isSaved = $qsFramesAlbum->save();

            // foreach ($request->input('price')as $price) {
            //     $price = (object) $price;
            //     $qsFramesAlbum->price()->create([
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
     * @param  \App\Models\QsFramesAlbum  $qsFramesAlbum
     * @return \Illuminate\Http\Response
     */
    public function show(QsFramesAlbum $qsFramesAlbum)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsFramesAlbum  $qsFramesAlbum
     * @return \Illuminate\Http\Response
     */
    public function edit(QsFramesAlbum $qsFramesAlbum)
    {
        $frameOrAlbum = FramesOrAlbum::all();
        $currency = Currency::all();
        return view('cms.framealbum.qs.edit',['frameOrAlbum' => $frameOrAlbum,'data' => $qsFramesAlbum,'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsFramesAlbum  $qsFramesAlbum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsFramesAlbum $qsFramesAlbum)
    {
        $validator = Validator($request->all(), [
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'type' => 'required|string|in:yesOrNo',
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            // 'price.*' => 'required|numeric',
            // 'price.*.value' => 'required|numeric',
            // 'price.*.currncyId' => 'required|numeric|exists:currencies,id',
        ]);
        if (!$validator->fails()) {

            $qsFramesAlbum->frames_or_album_id = $request->input('frames_or_album_id');
            $qsFramesAlbum->qs_ar = $request->input('qs_ar');
            $qsFramesAlbum->qs_en = $request->input('qs_en');
            $qsFramesAlbum->type = $request->input('type');
            $isSaved = $qsFramesAlbum->save();

            // $qsFramesAlbum->price()->delete();
            // foreach ($request->input('price') as $price) {
            //     $price = (object) $price;
            //     $qsFramesAlbum->price()->create([
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
     * @param  \App\Models\QsFramesAlbum  $qsFramesAlbum
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsFramesAlbum $qsFramesAlbum)
    {
        // $qsFramesAlbum->price()->delete();
    //    return $this->destroyTrait($qsFramesAlbum); 
    }
}
