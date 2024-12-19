<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'details' => $this->details,
            'isDefault' => boolval($this->isDefault),
            'country_id' => $this->country->id,
            'country' => $this->country->name,
            'city_id' => $this->city->id,
            'city' => $this->city->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
