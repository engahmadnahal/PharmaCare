<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::where('status', true)
                ->latest()
                ->get();

            return ControllersService::successResponse(
                __('cms.categories_retrieved_successfully'),
                CategoryResource::collection($categories)
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }

    public function products(Category $category)
    {
        try {
            $products = $category->products();

            return ControllersService::successResponse(
                __('cms.category_products_retrieved_successfully'),
                [
                    'category' => new CategoryResource($category),
                    'products' => ProductResource::collection($products),
                ]
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage($e->getMessage());
        }
    }
}
