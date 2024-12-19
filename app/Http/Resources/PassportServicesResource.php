<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PassportServicesResource extends JsonResource
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
            'isSoon' => boolval($this->soon),
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            "description" => $this->description,
            "description_en" => $this->description_en,
            "description_ar" => $this->description_ar,
            "overal_rate" => $this->overal_rate,
            "poster" => Storage::url($this->poster),
            'num_photo' => $this->num_photo,
            "photo_price" => $this->photo_price,
            "isNote" =>  boolval($this->isNote),
            "note" => $this->note,
            'slider_images' => $this->sliderImage(json_decode($this->slider_images)),
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
