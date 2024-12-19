<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrameChoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $numberPhoto = $this->type == "album" ? $this->num_photo . ' Photo' : "";
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title_ar' => $this->title_ar . ' '.$numberPhoto,
            'title_en' => $this->title_en . ' '.$numberPhoto,
            'image' => Storage::url($this->image),
            'price' => [
                'value' => $this->priceData?->priceKey ?? 0,
                'currency' => $this->priceData?->priceCurrencyCode ?? "",
            ]
        ];
    }

    
}
