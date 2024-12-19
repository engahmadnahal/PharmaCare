<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QsFrameResource extends JsonResource
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
            'qs_ar' => $this->qs_ar,
            'qs_en' => $this->qs_en,
            'qs_type' => $this->type,
            'price' => [
                'value' =>  0, // لتثبيت المودل في التطبيق
                'currency' => '',
            ],
        ];
    }
}
