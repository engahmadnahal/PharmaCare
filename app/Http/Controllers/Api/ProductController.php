<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShowProductResource;
use App\Models\FavoriteProduct;
use App\Models\Product;
use App\Models\RateProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with(['category', 'medicineType', 'pharmaceutical'])->get();

            return ControllersService::successResponse(
                __('cms.products_retrieved_successfully'),
                ProductResource::collection($products)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['category', 'medicineType', 'pharmaceutical', 'ratings'])
                ->findOrFail($id);

            return ControllersService::successResponse(
                __('cms.product_retrieved_successfully'),
                new ShowProductResource($product)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function toggleFavorite($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return ControllersService::generateValidationErrorMessage(__('cms.product_not_found'));
            }

            $favorite = FavoriteProduct::where('user_id', auth('user-api')->id())
                ->where('product_id', $id)
                ->first();

            if ($favorite) {
                $favorite->delete();
                $message = __('cms.product_removed_from_favorites');
            } else {
                FavoriteProduct::create([
                    'user_id' => auth('user-api')->id(),
                    'product_id' => $id
                ]);
                $message = __('cms.product_added_to_favorites');
            }

            return ControllersService::successResponse(
                $message,
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function rateProduct(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'rate' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $product = Product::findOrFail($id);

            $rating = RateProduct::updateOrCreate(
                [
                    'user_id' => auth('user-api')->id(),
                    'product_id' => $id
                ],
                ['rate' => $request->rate]
            );

            return ControllersService::successResponse(
                __('cms.product_rated_successfully'),
                new ProductResource($product)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function getFavorites()
    {
        try {
            $favorites = Product::whereHas('favoriteProducts', function ($query) {
                $query->where('user_id', auth('user-api')->id());
            })->get();

            return ControllersService::successResponse(
                __('cms.favorites_retrieved_successfully'),
                ProductResource::collection($favorites)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }
}
