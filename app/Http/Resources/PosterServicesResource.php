<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PosterServicesResource extends JsonResource
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
            // 'isSoon' => boolval($this->soon),
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            "about" => $this->about,
            "about_ar" => $this->about_ar,
            "about_en" => $this->about_en,
            // "overal_rate" => $this->overal_rate,
            // "poster" => Storage::url($this->poster),
            'slider_images' => $this->sliderImage(json_decode($this->slider_images)),
            'size' => $this->options->map(function ($e) {
                return [
                    'id' => $e->id,
                    'title' => $e->title,
                    'title_ar' => $e->title_ar,
                    'title_en' => $e->title_en,
                    'width' => $e->width,
                    'height' => $e->height,
                    'image' => Storage::url($e->image),
                    'price' => [
                        'value' => $e->priceData?->price ?? 0,
                        'currency' => $e->priceData?->currency?->code ?? "",
                    ],
                    // 'package' => PackagePosterResource::collection($e->package)
                ];
            })
        ];
    }



    public function sliderImage($imgs)
    {
        $data = [];
        foreach ($imgs as $img) {
            $data[] = Storage::url($img);
        }
        return $data;
    }
}
