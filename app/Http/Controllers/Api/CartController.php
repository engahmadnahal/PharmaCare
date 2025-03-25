<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CartResource;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator = Validator($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
        try {

            $product = Product::find($request->product_id);

            if (!$product) {
                return ControllersService::generateValidationErrorMessage(__('cms.product_not_found'));
            }

            if ($request->quantity > $product->quantity) {
                return ControllersService::generateValidationErrorMessage(__('cms.insufficient_stock', ['available_quantity' => $product->quantity]));
            }

            DB::beginTransaction();

            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->first();

            $requestedQuantity = $request->quantity;

            if ($cartItem) {
                $totalQuantity = $cartItem->quantity + $requestedQuantity;

                if ($totalQuantity > $product->quantity) {
                    return ControllersService::generateValidationErrorMessage(__('cms.insufficient_stock', ['available_quantity' => $product->quantity, 'cart_quantity' => $cartItem->quantity]));
                }

                $cartItem->quantity = $totalQuantity;
                $cartItem->save();

                $message = __('messages.cart_quantity_updated');
            } else {
                if ($requestedQuantity > $product->quantity) {
                    return ControllersService::generateValidationErrorMessage(__('cms.insufficient_stock', ['available_quantity' => $product->quantity]));
                }

                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'quantity' => $requestedQuantity
                ]);

                $message = __('messages.product_added_to_cart');
            }

            DB::commit();

            return ControllersService::successResponse($message);
        } catch (\Exception $e) {
            DB::rollBack();
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function showCart()
    {
        try {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();

            $summary = [
                'items_count' => $cartItems->sum('quantity'),
                'sub_total' => $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->retail_price;
                }),
            ];

            return ControllersService::successResponse(__('messages.cart_retrieved_successfully'), [
                'summary' => $summary,
                'items' => CartResource::collection($cartItems),
            ]);
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function removeFromCart($cartItemId)
    {
        try {
            $cartItem = Cart::where('user_id', auth()->id())
                ->whereId($cartItemId)
                ->first();

            if (!$cartItem) {
                return ControllersService::generateValidationErrorMessage(__('cms.cart_item_not_found'));
            }

            $cartItem->delete();

            return ControllersService::successResponse(__('messages.item_removed_from_cart'));
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function updateCartQuantity(Request $request, $cartItemId)
    {
        $validator = Validator($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            $cartItem = Cart::where('user_id', auth()->id())
                ->whereId($cartItemId)
                ->first();

            if (!$cartItem) {
                return ControllersService::generateValidationErrorMessage(__('cms.cart_item_not_found'));
            }

            if ($request->quantity > $cartItem->product->quantity) {
                return ControllersService::generateValidationErrorMessage(__('cms.insufficient_stock', [
                    'available_quantity' => $cartItem->product->quantity
                ]));
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            return ControllersService::successResponse(__('messages.cart_quantity_updated'));
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function clearCart()
    {
        try {
            Cart::where('user_id', auth()->id())->delete();
            return ControllersService::successResponse(__('messages.cart_cleared_successfully'));
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function applyCoupon(Request $request)
    {
        $validator = Validator($request->all(), [
            'code' => 'required|string|exists:coupons,code',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            // Get coupon
            $coupon = Coupon::where('code', $request->code)
                ->where('is_active', true)
                ->first();

            if (!$coupon) {
                return ControllersService::generateValidationErrorMessage(__('cms.invalid_coupon'));
            }

            // check if counpon is start date 
            if (Carbon::parse($coupon->start_date)->isFuture()) {
                return ControllersService::generateValidationErrorMessage(__('cms.coupon_not_started'));
            }
            // Check if coupon is expired
            if (Carbon::parse($coupon->end_date)->isPast()) {
                return ControllersService::generateValidationErrorMessage(__('cms.coupon_expired'));
            }

            // Check if coupon usage limit is reached
            if ($coupon->uses >= $coupon->max_uses) {
                return ControllersService::generateValidationErrorMessage(__('cms.coupon_usage_limit_reached'));
            }

            // Get cart items
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();

            if ($cartItems->isEmpty()) {
                return ControllersService::generateValidationErrorMessage(__('cms.cart_is_empty'));
            }

            // Calculate cart total
            $cartTotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->retail_price;
            });

            // Calculate discount
            $discountAmount = ($cartTotal * $coupon->discount) / 100;
            $totalAfterDiscount = $cartTotal - $discountAmount;


            return ControllersService::successResponse(
                __('messages.coupon_applied_successfully'),
                [
                    'cart_summary' => [
                        'sub_total' => round($cartTotal, 2),
                        'discount_amount' => round($discountAmount, 2),
                        'total_after_discount' => round($totalAfterDiscount, 2),
                    ]
                ]
            );
        } catch (\Exception $e) {
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }

    public function checkout(Request $request)
    {
        $validator = Validator($request->all(), [
            'coupon_code' => 'nullable|exists:coupons,code',
            'payment_method' => 'required|in:cash,online',
            'note' => 'nullable|string|max:255',
            'user_address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        try {
            DB::beginTransaction();

            // Get cart items
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();

            if ($cartItems->isEmpty()) {
                return ControllersService::generateValidationErrorMessage(__('cms.cart_is_empty'));
            }

            // Calculate subtotal
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->retail_price;
            });

            $couponDiscount = 0;
            $coupon = null;

            // Apply coupon if provided
            if ($request->coupon_code) {
                $coupon = Coupon::where('code', $request->coupon_code)
                    ->where('is_active', true)
                    ->first();

                if ($coupon) {
                    // check if counpon is start date 
                    if (Carbon::parse($coupon->start_date)->isFuture()) {
                        return ControllersService::generateValidationErrorMessage(__('cms.coupon_not_started'));
                    }
                    // Check if coupon is expired
                    if (Carbon::parse($coupon->end_date)->isPast()) {
                        return ControllersService::generateValidationErrorMessage(__('cms.coupon_expired'));
                    }

                    // Check if coupon usage limit is reached
                    if ($coupon->uses >= $coupon->max_uses) {
                        return ControllersService::generateValidationErrorMessage(__('cms.coupon_usage_limit_reached'));
                    }

                    $couponDiscount = ($subtotal * $coupon->discount) / 100;
                }
            }

            // Create order
            $order = Order::create([
                'order_num' => 'ORD-' . Str::random(8),
                'user_id' => auth()->id(),
                'coupon_id' => $coupon ? $coupon->id : null,
                'coupon_discount' => $couponDiscount,
                'shipping' => 0, // You can add shipping calculation logic here
                'subtotal' => $subtotal,
                'total' => $subtotal - $couponDiscount,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
                'user_full_name' => auth()->user()->full_name,
                'user_address' => $request->user_address,
                'user_email' => auth()->user()->email,
                'user_mobile' => auth()->user()->mobile,
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                // Check stock availability
                if ($item->quantity > $item->product->quantity) {
                    DB::rollBack();
                    return ControllersService::generateValidationErrorMessage(__('cms.insufficient_stock_for_product', [
                        'product' => $item->product->tradeName,
                        'available' => $item->product->quantity
                    ]));
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->retail_price,
                    'total' => $item->quantity * $item->product->retail_price,
                ]);

                // Update product quantity
                $item->product->decrement('quantity', $item->quantity);
            }

            // Update coupon usage if used
            if ($coupon) {
                $coupon->increment('uses');
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return ControllersService::successResponse(__('cms.success_checkout'), [
                'order_num' => $order->order_num,
                'subtotal' => round($subtotal, 2),
                'coupon_discount' => round($couponDiscount, 2),
                'shipping' => round($order->shipping, 2),
                'total' => round($order->total, 2),
                'payment_method' => $order->payment_method,
                'status' => $order->status
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ControllersService::generateValidationErrorMessage(__('cms.something_went_wrong'));
        }
    }
}
