<?php

namespace App\Http\Resources\Cart;

use App\Models\PassportOption;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PassportResource extends JsonResource
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
            'master_service_id' => $this->masterServiceId,
            'type' => 'passport',
            'isRate' => $this->isRate,
            'rate' => $this->rate,
            'title_ar' => $this->masterService->title_ar,
            'title_en' => $this->masterService->title_en,
            'description_ar' => $this->passportType->title_ar,
            'description_en' => $this->passportType->title_en,
            'copies' => null,
            'people_num' => null,
            'photo_num' => null,
            'quantity' => $this->quantity,
            'note_user' => $this->note,
            'note_app_ar' => ' سيتم حذف الصور بعد 3 أيام من الاستلام',
            'note_app_en' => 'Photos will be deleted 3 days after receipt',
            'total' => [
                'val' => number_format($this->totalService,2,'.',''),
                'currency' => auth()->user()->currencyCode,
            ],
            'images_count' => $this->images->count(),
            'images' => $this->images->map(function($e){
                return Storage::url($e->path);
            }),
        ];
    }


}
