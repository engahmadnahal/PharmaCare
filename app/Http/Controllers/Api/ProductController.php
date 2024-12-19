<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\Product\ProductResource;
use App\Models\MyCart;
use App\Models\Product;
use App\Models\ProductBooking;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getBooking()
    {
        $data = Product::where('active', true)->where('type', 'user')->get();
        return response()->json(new SuccessResponse('SUCCESS_GET', ProductResource::collection($data)));
    }

    public function setBooking(Request $request)
    {
        $validator = Validator($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'amount' => 'required|integer'
        ]);

        if (!$validator->fails()) {
            $product = Product::find($request->product_id);
            if ($product->num_items < $request->amount) {
                return response()->json(new ErrorResponse('STOCK_NOT_ENOUGH'));
            }
            $productBooking = new ProductBooking();
            $productBooking->product_id = $request->product_id;
            $productBooking->amount = $request->amount;
            $productBooking->user_id = auth()->user()->id;
            $saved = $productBooking->save();
            if ($saved) {
                $cart = new MyCart();
                $cart->object_type = ProductBooking::class;
                $cart->object_id = $productBooking->id;
                $cart->user_id = auth()->user()->id;
                $cart->save();
                return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
            }
            return response()->json(new ErrorResponse('ERROR_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
