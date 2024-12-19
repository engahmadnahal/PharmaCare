<?php

namespace App\Http\Resources;

use App\Models\AlbumSize;
use App\Models\FramesSize;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrameAlbumServicesResource extends JsonResource
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
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            "about_ar" => $this->about_ar,
            "about_en" => $this->about_en,
            'slider_images' => $this->sliderImage(json_decode($this->slider_images)),
            'options' => $this->options->map(function($e){
                return [
                    'id' => $e->id,
                    'title' => $e->title,
                    'title_ar' => $e->title_ar,
                    'title_en' => $e->title_en,
                    'image' => Storage::url($e->image),
                    'price' => [
                        'value' => $e->priceData?->priceKey ?? 0,
                        'currency' => $e->priceData?->priceCurrencyCode ?? "",
                    ],
                    
                ];
            })
        ];
    }

   

    public function sliderImage($imgs){
        $data = [];
        foreach($imgs as $img){
            $data[] = Storage::url($img);
        }
        return $data;
    }
}
