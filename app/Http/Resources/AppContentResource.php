<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AppContentResource extends JsonResource
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
            'image' => Storage::url($this->image),
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'body_ar' => $this->body_ar,
            'body_en' => $this->body_en,
        ];
    }
}
