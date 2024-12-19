<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostcardPackageResource extends JsonResource
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
            // 'poster_size' => Storage::url($this->sizeOrtype->image),
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'image' => Storage::url($this->image),
            'max_item' => intval($this->num_item_over),
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
        ];
    }
}
