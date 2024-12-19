<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PackagePosterResource extends JsonResource
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
            'max_item' => $this->num_item_over,
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
            // 'print_choices' => PrintOptionPackagePosterResource::collection($this->options->where('type','print')),
            // 'frame_choices' => FrameOptionPackagePosterResource::collection($this->options->where('type','frame')),
            // 'print_color_choices' => PrintColorOptionPackagePosterResource::collection($this->options->where('type','printColor')),
        ];
    }
}
