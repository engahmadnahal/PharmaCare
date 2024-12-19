<?php

namespace App\Http\Resources\Order;

use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'order_num' => $this->order_num,
            'price' => [
                'value' => (double) $this->cost,
                'currency' => $this->currency->code
            ],
            'order_status' => new OrderStatusResource($this->orderStatus)
        ];
    }
}
