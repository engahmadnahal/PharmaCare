<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrameOptionPackagePosterResource extends JsonResource
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
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'image' => Storage::url($this->image),
            'isPrice' => boolval($this->isPrice),
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price?? 0,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
        ];;
    }
}
