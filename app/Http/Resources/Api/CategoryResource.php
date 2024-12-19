<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SubCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'image' => Storage::url($this->image),
            'icon' => Storage::url($this->icon),
            'sub_category' => SubCategoryResource::collection($this->subCategories) 
        ];
    }
}
