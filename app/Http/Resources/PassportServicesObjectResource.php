<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PassportServicesObjectResource extends JsonResource
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
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'image_example' => Storage::url($this->image),
            'note' => $this->note ?? '',
            'note_en' => $this->note_en ?? '',
            'isNote' => boolval($this->isNote),
            'num_photo' => intval($this->num_photo), // عدد الصور
            'num_add' => intval($this->num_add), // مقدار الاضافة على عدد الصور ، بعد الحد المسموح
            'price_elm_percentage' => doubleval($this->price_elm),
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
            'slider_images' => $this->sliderImage(json_decode($this->passport->slider_images))
            // "country" => new CountryResource($this->country),
            // 'passport_type' => new PassportTypeResource($this->type),

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
