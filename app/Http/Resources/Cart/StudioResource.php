<?php

namespace App\Http\Resources\Cart;

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
            'id' => $this->id,
            'type' => 'studio',
            'latidute' => (double) $this->studio->latidute,
            'longitude' => (double) $this->studio->longitude,
            'studio_id' => $this->studio?->id ?? '',
            'studio_name' => $this->studio?->name ?? '',
            'master_service_id' => $this->masterService?->id,
            'isRate' => $this->isRate,
            'rate' => $this->rate,
            'title_ar' => $this->masterService->title_ar,
            'title_en' => $this->masterService->title_en,
            'description_ar' => $this->masterService->about_ar,
            'description_en' => $this->masterService->about_en,
            'copies' => null,
            'photo_num' => null,
            'quantity' => $this->qty,
            'people_num' => $this->people_num,
            'note_user' => $this->msg,
            'note_app_ar' => ' سيتم حذف الصور بعد 3 أيام من الاستلام',
            'note_app_en' => 'Photos will be deleted 3 days after receipt',
            'total' => [
                'val' => number_format($this->totalService,2,'.',''),
                'currency' => auth()->user()->currencyCode,
            ],
            'images_count' => 0,
            'images' => [],
        ];
    }
}
