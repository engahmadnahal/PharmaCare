<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostcardPackageBookingResource extends JsonResource
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
                'copies' => $this->bookingUser?->copies,
                'photo_num' => $this->bookingUser?->photo_num,
                'note' => $this->bookingUser?->note,
                'images' => !is_null($this->bookingUser?->images) ? ImageResource::collection($this->bookingUser?->images) : []
                
            ]),
            'id' => $this->id,
            'title_ar' => "بطاقة بريدية ({$this->sizeOrtype->title_ar})",
            'title_en' => "Postcard ({$this->sizeOrtype->title_en})",
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'image' => Storage::url($this->image),
            'max_item' => intval($this->num_item_over),
            'min_item' => $this->min_item,
            'discount_value' => $this->discount_value  / 100,
            'delivaly_value' => doubleval(0),
            'tax' => $this->sizeOrtype->service->is_tax ? $this->taxValue / 100 : 0,
            'size_to_byte' => $this->calcToByte($this->type_size,$this->min_size_image),
            'note_en' => 'Note: The image file size is more than '.$this->min_size_image .''.$this->type_size,
            'note_ar' => $this->min_size_image .''.$this->type_size.' ملاحظة: حجم ملف الصورة أكثر من ',
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price ?? 0,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
        ];
    }


    private function calcToByte($type,$size){
        if($type == 'MB'){
            return $this->calcMBToByte($size);
        }else if($type == 'KB'){
            return $this->calcKBToByte($size);
        }
        return 0;
        
    }

    private function calcKBToByte($size){
        // 1 kb == 1000
        return $size * 1000;
    }

    private function calcMBToByte($size){
        // 1 mg == 1000000
        return $size * 1000000;

    }
}
