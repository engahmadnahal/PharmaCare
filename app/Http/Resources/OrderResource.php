<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_num' => $this->order_num,
            'created_at' => $this->created_at->format('Y-m-d'),
            'status' => $this->status,
            'total' => (float) $this->total,
            'discount' => (float) ($this->discount + $this->coupon_discount),
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'shipping' => (float) $this->shipping,
        ];
    }
} 