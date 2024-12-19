<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppFaqsResource extends JsonResource
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
            'qs_ar' => $this->qs_ar,
            'qs_en' => $this->qs_en,
            'answer_ar' => $this->answer_ar,
            'answer_en' => $this->answer_en,
        ];
    }
}
