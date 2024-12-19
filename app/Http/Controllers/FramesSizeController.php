<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\FramesOrAlbum;
use App\Models\FramesSize;
use App\Models\Product;
use App\Models\QsFramesAlbum;
use App\Models\SizeQsFrameAlbume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FramesSizeController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = FramesSize::with('product', 'product.price.currency', 'option')->get();
        return view('cms.framealbum.framesize.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frameOrAlbum = FramesOrAlbum::all();
        $currency = Currency::all();
        $qs = QsFramesAlbum::all();
        $products = Product::where('type', 'user')->where('active', true)->get();
        return view('cms.framealbum.framesize.create', ['frameOrAlbum' => $frameOrAlbum, 'currency' => $currency, 'qs' => $qs, 'products' => $products]);
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
            'product_id' => 'required|integer|exists:products,id',
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'qs_id' => 'nullable|numeric|exists:qs_frames_albums,id',

            'price_qs.*.value' => [
                'nullable',
                'integer'
            ],
            'price_qs.*.currncyId' => [
                'nullable', 'integer', 'exists:currencies,id'
            ],

            // 'price_qs.*.value' => 'required|integer',
            // 'price_qs.*.currncyId' => 'required|integer|exists:currencies,id',

        ]);
        if (!$validator->fails()) {

            $isSaved = DB::transaction(function () use ($request) {
                $framesSize = new FramesSize();
                $framesSize->frames_or_album_id = $request->input('frames_or_album_id');
                $framesSize->width = $request->input('width');
                $framesSize->height = $request->input('height');
                $framesSize->product_id = $request->input('product_id');
                $isSaved = $framesSize->save();

                if ($isSaved && !is_null($request->qs_id)) {
                    $qs = QsFramesAlbum::findOrFail($request->qs_id);
                    $sizeQsFrameAlbume = new SizeQsFrameAlbume();
                    $sizeQsFrameAlbume->frames_size_id = $framesSize->id;
                    $sizeQsFrameAlbume->qs_frames_album_id = $qs->id;
                    $savedQs = $sizeQsFrameAlbume->save();


                    if (!is_null($request->input('price_qs'))) {
                        foreach ($request->input('price_qs') as $priceQs) {
                            $sizeQsFrameAlbume->price()->create([
                                'currency_id' => $priceQs['currncyId'],
                                'price' => $priceQs['value']
                            ]);
                        }
                    }
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
     * @param  \App\Models\FramesSize  $framesSize
     * @return \Illuminate\Http\Response
     */
    public function show(FramesSize $framesSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FramesSize  $framesSize
     * @return \Illuminate\Http\Response
     */
    public function edit(FramesSize $framesSize)
    {
        $frameOrAlbum = FramesOrAlbum::all();
        $currency = Currency::all();
        $qs = QsFramesAlbum::all();
        $products = Product::where('type', 'user')->where('active', true)->get();
        $sizeQsFrameAlbume = SizeQsFrameAlbume::where('frames_size_id', $framesSize->id)->first();
        return view('cms.framealbum.framesize.edit', [
            'products' => $products,
            'sizeQsFrameAlbume' => $sizeQsFrameAlbume,
            'frameOrAlbum' => $frameOrAlbum,
            'data' => $framesSize,
            'currency' => $currency,
            'qs' => $qs
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FramesSize  $framesSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FramesSize $framesSize)
    {
        $validator = Validator($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'qs_id' => 'nullable|numeric|exists:qs_frames_albums,id',
            'price_qs.*.value' => [
                'nullable',
                'integer'
            ],
            'price_qs.*.currncyId' => [
                'nullable', 'integer', 'exists:currencies,id'
            ],
        ]);
        if (!$validator->fails()) {

            $isSaved = DB::transaction(function () use ($request, $framesSize) {
                $framesSize->frames_or_album_id = $request->input('frames_or_album_id');
                $framesSize->width = $request->input('width');
                $framesSize->product_id = $request->input('product_id');
                $framesSize->height = $request->input('height');
                $isSaved = $framesSize->save();


                if ($isSaved && !is_null($request->input('qs_id'))) {
                    $qs = QsFramesAlbum::findOrFail($request->qs_id);
                    $sizeQsFrameAlbume = SizeQsFrameAlbume::where('frames_size_id', $framesSize->id)->first();
                    if (is_null($sizeQsFrameAlbume)) {
                        $sizeQsFrameAlbume = new SizeQsFrameAlbume();
                    }

                    $sizeQsFrameAlbume->frames_size_id = $framesSize->id;
                    $sizeQsFrameAlbume->qs_frames_album_id = $qs->id;
                    $savedQs = $sizeQsFrameAlbume->save();


                    if (!is_null($request->input('price_qs'))) {

                        $sizeQsFrameAlbume->price()->delete();
                        foreach ($request->input('price_qs') as $priceQs) {
                            $sizeQsFrameAlbume->price()->create([
                                'currency_id' => $priceQs['currncyId'],
                                'price' => $priceQs['value']
                            ]);
                        }
                    }
                }

                return $isSaved;
            });

            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FramesSize  $framesSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(FramesSize $framesSize)
    {
        return $this->destroyTrait($framesSize);
    }
}
