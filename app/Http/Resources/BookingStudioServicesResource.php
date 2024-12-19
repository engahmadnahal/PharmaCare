<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BookingStudioServicesResource extends JsonResource
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
            'type'=> $this->type,
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'poster' => Storage::url($this->poster),
            'isSoon' => boolval($this->soon),
            'overal_rate' => $this->overal_rate,
            'slider_images' => $this->sliderImage(json_decode($this->slider_images)),
            // 'size_or_type' => $this->when($this->options != null,$this->options)
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
