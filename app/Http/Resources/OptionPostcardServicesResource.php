<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OptionPostcardServicesResource extends JsonResource
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
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'width' => $this->width,
            'height' => $this->height,
            'image' => Storage::url($this->image),
            'price' => $this->price,
            'options' => $this->subOptions->map(function ($subOption) {
                return [
                    'id' => $subOption->id,
                    'description' => $subOption->description,
                    'description_ar' => $subOption->description_ar,
                    'description_en' => $subOption->description_en,
                    'image' => Storage::url($subOption->image),
                    'min_price' => $subOption->min_price,
                    'num_item_min' => $subOption->num_item_min,
                    'over_price' => $subOption->over_price,
                    'num_item_over' => $subOption->num_item_over,
                ];
            })
        ];
    }
}
