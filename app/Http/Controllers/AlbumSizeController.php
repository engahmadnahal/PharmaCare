<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\AlbumSize;
use App\Models\Currency;
use App\Models\FramesOrAlbum;
use App\Models\Product;
use App\Models\QsFramesAlbum;
use App\Models\SizeQsFrameAlbume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class AlbumSizeController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AlbumSize::with('product', 'product.price.currency', 'option')->get();
        return view('cms.framealbum.ablumsize.index', ['data' => $data]);
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
        return view('cms.framealbum.ablumsize.create', [
            'products' => $products,
            'qs' => $qs,
            'frameOrAlbum' => $frameOrAlbum,
            'currency' => $currency
        ]);
        //
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
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'qs_id' => 'nullable|numeric|exists:qs_frames_albums,id',
            // 'price_qs.*.value' => [
            //     'nullable',
            //     'integer'
            // ],
            // 'price_qs.*.currncyId' => [
            //     'nullable'
            //     ,'integer','exists:currencies,id'
            // ],
            'product_id' => 'required|integer|exists:products,id',


        ]);
        if (!$validator->fails()) {

            $isSaved = DB::transaction(function () use ($request) {

                $albumSize = new AlbumSize();
                $albumSize->frames_or_album_id = $request->input('frames_or_album_id');
                // $albumSize->num_photo = $request->input('num_photo');
                $albumSize->width = $request->input('width');
                $albumSize->product_id = $request->input('product_id');
                $albumSize->height = $request->input('height');
                $isSaved = $albumSize->save();


                if ($isSaved && !is_null($request->qs_id)) {
                    $qs = QsFramesAlbum::findOrFail($request->qs_id);
                    $sizeQsFrameAlbume = new SizeQsFrameAlbume();
                    $sizeQsFrameAlbume->album_size_id = $albumSize->id;
                    $sizeQsFrameAlbume->qs_frames_album_id = $qs->id;
                    $savedQs = $sizeQsFrameAlbume->save();
                    // foreach ($request->input('price_qs') as $priceQs) {
                    //     $sizeQsFrameAlbume->price()->create([
                    //         'currency_id' => $priceQs['currncyId'],
                    //         'price' => $priceQs['value']
                    //     ]);
                    // }
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
     * @param  \App\Models\AlbumSize  $albumSize
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumSize $albumSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumSize  $albumSize
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumSize $albumSize)
    {
        $frameOrAlbum = FramesOrAlbum::all();
        $qs = QsFramesAlbum::all();
        $currency = Currency::all();
        $sizeQsFrameAlbume = SizeQsFrameAlbume::where('album_size_id', $albumSize->id)->first();
        $products = Product::where('type', 'user')->where('active', true)->get();
        return view('cms.framealbum.ablumsize.edit', [
            'products' => $products,
            'sizeQsFrameAlbume' => $sizeQsFrameAlbume,
            'qs' => $qs,
            'frameOrAlbum' => $frameOrAlbum,
            'data' => $albumSize,
            'currency' => $currency
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumSize  $albumSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlbumSize $albumSize)
    {
        //
        $validator = Validator($request->all(), [
            'frames_or_album_id' => 'required|string|exists:frames_or_albums,id',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'price.*' => 'required|numeric',
            'qs_id' => 'nullable|numeric|exists:qs_frames_albums,id',
            // 'price_qs.*.value' => 'required|integer',
            // 'price_qs.*.currncyId' => 'required|integer|exists:currencies,id',
            'product_id' => 'required|integer|exists:products,id',
        ]);
        if (!$validator->fails()) {


            $isSaved = DB::transaction(function () use ($request, $albumSize) {

                $albumSize->frames_or_album_id = $request->input('frames_or_album_id');
                // $albumSize->num_photo = $request->input('num_photo');
                $albumSize->width = $request->input('width');
                $albumSize->height = $request->input('height');
                $isSaved = $albumSize->save();

                if ($isSaved && !is_null($request->qs_id)) {
                    $qs = QsFramesAlbum::findOrFail($request->qs_id);
                    $sizeQsFrameAlbume = SizeQsFrameAlbume::where('album_size_id', $albumSize->id)->first();
                    $sizeQsFrameAlbume->qs_frames_album_id = $qs->id;
                    $albumSize->product_id = $request->input('product_id');
                    $savedQs = $sizeQsFrameAlbume->save();

                    // $sizeQsFrameAlbume->price()->delete();
                    // foreach ($request->input('price_qs') as $priceQs) {
                    //     $sizeQsFrameAlbume->price()->create([
                    //         'currency_id' => $priceQs['currncyId'],
                    //         'price' => $priceQs['value']
                    //     ]);
                    // }
                }

                return $isSaved && $savedQs;
            });

            return ControllersService::generateProcessResponse($isSaved, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumSize  $albumSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumSize $albumSize)
    {
        return $this->destroyTrait($albumSize);
    }
}
