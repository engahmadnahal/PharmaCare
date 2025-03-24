<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' =>  $this->tradeName,
            'description' =>  $this->drugDescription,
            'basic_price' => $this->basic_price,
            'retail_price' => $this->retail_price,
            'discount' => $this->basic_price - $this->retail_price,
            'image' => Storage::url($this->image),
            'is_favorite' => (bool) $this->isFavorited,
            'category' => $this->category?->name,
            'medicine_type' => $this->medicineType?->name,
            'concentration' => $this->concentration_value . ' ' . $this->concentration_unit,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
