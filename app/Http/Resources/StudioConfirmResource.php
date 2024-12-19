<?php

namespace App\Http\Resources;

use App\Helpers\ConvertToMeters;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StudioConfirmResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            "address" => $this->address,
            "poster" => Storage::url($this->avater),
            'overal_rate' => $this->overal_rate,
            'distance' => $this->distance,
            "latidute" => $this->latidute,
            "longitude" => $this->longitude,
            "is_lawful_service" => (bool) $this->is_lawful_service,
            'services' => join(',',$this->services->pluck('name_en')->toArray()),
            'slider_image' => $this->sliderImage(json_decode($this->slider_images)),
            // 'services' => StudioServicesResource::collection($this->services)
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
