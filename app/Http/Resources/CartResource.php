<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->trade_name,
                'image' => Storage::url($this->product->image),
                'basic_price' => (float) $this->product->basic_price,
                'retail_price' => (float) $this->product->retail_price,
                'discount_price' => (float) $this->product->basic_price - $this->product->retail_price,
                'available_quantity' => $this->product->quantity,
                'total_price' => (float) ($this->product->retail_price * $this->quantity),
            ],
        ];
    }
}
