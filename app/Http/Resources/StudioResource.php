<?php

namespace App\Http\Resources;

use App\Helpers\ConvertToMeters;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CountryResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StudioResource extends JsonResource
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
            'user_booking' => $this->when(!is_null($this->bookingUser),[
                'services_id' => $this->bookingUser?->services_booking_studio_id,
                'quantity' => $this->bookingUser?->qty,
                'note' => $this->bookingUser?->note,
                'date' => Carbon::parse($this->bookingUser?->date)->format('Y/n/j'),
                'time_from' => $this->bookingUser?->time_from,
                'people_num' => $this->bookingUser?->people_num ?? 0
            ]),
            "id" => $this->id,
            "name" => $this->name,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            "address" => $this->address,
            "poster" => Storage::url($this->avater),
            'overal_rate' => $this->overal_rate ?? 0,
            'distance' => $this->distance,
            "latidute" => $this->latidute,
            "longitude" => $this->longitude,
            'tax' => $this->taxValue,
            'slider_image' => $this->sliderImage(json_decode($this->slider_images)),
            'services' => StudioServicesResource::collection($this->bookginServicesStudio)
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
