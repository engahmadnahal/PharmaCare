<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\Currency;
use App\Models\Product;
use App\Models\StoreHouse;
use App\Models\StudioBranch;
use App\Models\StudioProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('studiobranch')->check()) {
            $data = Product::where('active', true)->get();
            return view('cms.products.index_studio', ['data' => $data]);
        }
        $data = Product::all();
        return view('cms.products.index', ['data' => $data]);
    }


    public function studioProduct()
    {
        $data = StudioProduct::with('product')->where('studio_branch_id', auth()->user()->id)->get();
        return view('cms.products.studio_product', [
            'data' => $data
        ]);
    }

    public function distribution(Product $product)
    {
        $currency = Currency::all();
        $studios = StudioBranch::where('block', false)
            ->where('active', true)
            ->where('isAcceptable', 'accept')
            ->get();

        return view('cms.products.distribution', [
            'product' => $product,
            'studios' => $studios,
            'currency' => $currency
        ]);
    }


    public function distributionToStudio(Request $request, Product $product)
    {
        $validator = Validator($request->all(), [
            'item_count' => 'required|integer|min:0|max:' . $product->num_items,
            'price' => 'nullable|numeric',
            'studio_id' => 'required|integer|exists:studio_branches,id',
            'currency_id' => 'required|string|exists:currencies,id',
        ]);
        if (!$validator->fails()) {

            if ($product->num_items < $request->item_count) {
                return ControllersService::generateValidationErrorMessage(Messages::getMessage('STOCK_NOT_ENOUGH'));
            }

            $isSaved = DB::transaction(function () use ($request, $product) {
                // السعر بسعر الجملة بدون اي تحديد من الادمن
                $priceElm = $product->joomla->where('currency_id', $request->currency_id)->first()?->price;
                $totalPrice = $priceElm  * $request->item_count;

                $studioProduct = new StudioProduct();
                $studioProduct->product_id = $product->id;
                $studioProduct->studio_branch_id = $request->studio_id;
                $studioProduct->currency_id = $request->currency_id;
                if (!is_null($request->price)) {
                    $studioProduct->current_price = $request->price;
                } else {
                    $studioProduct->current_price = $totalPrice;
                }
                $studioProduct->total_price = $totalPrice;
                $studioProduct->amount = $request->item_count;
                $studioProduct->price_elm = $priceElm;
                $isSave = $studioProduct->save();

                if ($isSave) {
                    $product->num_items = $product->num_items - $request->item_count;
                    $isSave = $product->save();
                }

                return $isSave;
            });

            return ControllersService::generateProcessResponse($isSaved, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Currency::all();
        $sotreohuse = StoreHouse::where('active', true)->get();
        return view('cms.products.create', ['sotreohuse' => $sotreohuse, 'currency' => $currency]);
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',

            'description_ar' => 'required|string',
            'description_en' => 'required|string',


            'image' => 'nullable|image|mimes:png,jpg',
            'type' => 'required|string|in:user,studio',
            'num_item' => 'required|numeric',
            'active' => 'required|boolean',
            'price.*' => 'required|numeric',
            'price_joomla.*' => 'required|numeric',
            'store_house_id' => 'required|string|exists:store_houses,id',
        ]);
        if (!$validator->fails()) {
            
            $isSaved = DB::transaction(function () use ($request) {


                $product = new Product();
                $product->description_ar = $request->input('description_ar');
                $product->description_en = $request->input('description_en');

                $product->name_ar = $request->input('name_ar');
                $product->name_en = $request->input('name_en');
                $product->num_items = $request->input('num_item');
                $product->type = $request->input('type');
                $product->store_house_id = $request->input('store_house_id');
                $product->active = $request->input('active');
                $product->image = $this->uploadFile($request->file('image'), 'products');
                $isSaved = $product->save();

                $priceCreate = [];
                $joomlaCreate = [];

                foreach (json_decode($request->input('price')) as $price) {
                    $priceCreate[] = [
                        'currency_id' => $price->currncyId,
                        'price' => $price->value,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }

                foreach (json_decode($request->input('price_joomla')) as $price) {
                    $priceCreate[] = [
                        'currency_id' => $price->currncyId,
                        'price' => $price->value,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }

                try {

                    $product->price()->insert($priceCreate);
                    $product->joomla()->insert($joomlaCreate);

                    $isSaved = true;
                } catch (Exception $e) {
                    $isSaved = false;
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('cms.products.show', [
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $sotreohuse = StoreHouse::where('active', true)->get();
        $currency = Currency::all();
        return view('cms.products.edit', ['sotreohuse' => $sotreohuse, 'product' => $product, 'currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator($request->all(), [
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg',
            'type' => 'required|string|in:user,studio',
            'num_item' => 'required|numeric',
            'active' => 'required|boolean',
            'price.*' => 'required|numeric',
            'store_house_id' => 'required|string|exists:store_houses,id',
            'price_joomla.*' => 'required|numeric',
        ]);
        if (!$validator->fails()) {
            $product->description_ar = $request->input('description_ar');
            $product->description_en = $request->input('description_en');
            $product->name_ar = $request->input('name_ar');
            $product->name_en = $request->input('name_en');
            $product->num_items = $request->input('num_item');
            $product->type = $request->input('type');
            $product->store_house_id = $request->input('store_house_id');
            $product->active = $request->input('active');
            if ($request->hasFile('image')) {
                $product->image = $this->uploadFile($request->file('image'), 'products');
            }
            $saved = $product->save();

            if ($saved) {
                if ($product->price()->delete()) {
                    foreach (json_decode($request->input('price')) as $price) {
                        $product->price()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }
                //
                if ($product->joomla()->delete()) {
                    foreach (json_decode($request->input('price_joomla')) as $price) {
                        $product->joomla()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }
            }
            return ControllersService::generateProcessResponse(true, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->price()->delete()) {
            if ($product->joomla()->delete()) {
                return $this->destroyTrait($product);
            }
        }
        return ControllersService::generateProcessResponse(false, 'DELETE');
    }
}
