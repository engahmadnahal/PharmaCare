<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'master_service_id' => $this->product->id,
            'type' => 'product',
            'isRate' => $this->isRate,
            'rate' => $this->rate,
            'title_ar' => $this->product->name_ar,
            'title_en' => $this->product->name_en,
            'description_ar' => $this->product->description_ar,
            'description_en' => $this->product->description_en,
            'copies' => 0,
            'photo_num' => 0,
            'quantity' => $this->amount,
            'note_user' => "",
            'note_app_ar' => ' سيتم حذف الصور بعد 3 أيام من الاستلام',
            'note_app_en' => 'Photos will be deleted 3 days after receipt',
            'total' => [
                'val' => number_format($this->totalService,2,'.',''),
                'currency' => $this->product->currencyKey,
            ],
            'images_count' => [],
            'images' => [],
        ];
    }
}
