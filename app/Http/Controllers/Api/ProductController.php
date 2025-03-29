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
    public function index(Request $request)
    {

        $validator = Validator($request->all(), [
            'category_id' => 'nullable|exists:categories,id',
            'pharmaceutical_id' => 'nullable|exists:pharmaceuticals,id',
            'is_favorite' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $products = Product::with(['category', 'medicineType', 'pharmaceutical'])
            ->when(!is_null($request->category_id), function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->when(!is_null($request->pharmaceutical_id), function ($query) use ($request) {
                return $query->where('pharmaceutical_id', $request->pharmaceutical_id);
            })
            ->when(!is_null($request->is_favorite) && $request->is_favorite == 1, function ($query) use ($request) {
                return $query->whereHas('favoriteProducts', function ($query) use ($request) {
                    $query->where('user_id', auth('user-api')->id());
                });
            })
            ->when(!is_null($request->is_favorite) && $request->is_favorite == 0, function ($query) use ($request) {
                return $query->whereDoesntHave('favoriteProducts', function ($query) use ($request) {
                    $query->where('user_id', auth('user-api')->id());
                });
            })
            ->get();

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
            $product = Product::with(['category', 'medicineType', 'pharmaceutical', 'rateProducts'])
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

            $product->update([
                'rate' => $product->rateProducts()->avg('rate')
            ]);

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
