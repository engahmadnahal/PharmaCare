<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Decimal;

class PassporteBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function toArray($request)
    {

        $basePrice = $this->price->where('currency_id',auth()->user()->currency)->first()?->price  ?? 0;
        $pricePhotoAfterIncrse = $this->priceAfterIncres->where('currency_id',auth()->user()->currency)->first()?->price  ?? 0;
        $price = ($basePrice * 0.5) - $pricePhotoAfterIncrse;

        return [
            'user_booking' => $this->when(!is_null($this->bookingUser),[
                'country_id' => $this->bookingUser?->passport_country_id,
                'passport_type_id' => $this->bookingUser?->passport_type_id,
                'quantity' => $this->bookingUser?->quantity,
                'note' => $this->bookingUser?->note,
                'images' => !is_null($this->bookingUser?->images) ? ImageResource::collection($this->bookingUser?->images) : []
            ]),
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'poster' => Storage::url($this->passport->poster),
            'picture_note_ar' => $this->note ?? '',
            'picture_note_en' => $this->note_en ?? '',
            'isNote' => boolval($this->isNote),
            'num_photo' => intval($this->num_photo), // عدد الصور
            'num_add' => intval($this->num_add), // مقدار الاضافة على عدد الصور ، بعد الحد المسموح
            'price_elm_percentage' => 0,
            'value_price_after_increase' => number_format($pricePhotoAfterIncrse,2), // قيمة الخصم الاساسية بدون اي معادلة€€
            'result_price_after_increase' => number_format($price,2), // الناتج بعد المعادلة
            'discount_value' => $this->discount_value  / 100,
            'delivaly_value' => 0,
            'tax' => $this->passport?->is_tax ? $this->passport?->tax / 100 : 0,
            'size_to_byte' => $this->calcToByte($this->type_size,$this->min_size_image),
            'note_en' => 'Note: The image file size is more than '.$this->min_size_image .''.$this->type_size,
            'note_ar' => $this->min_size_image .''.$this->type_size.' ملاحظة: حجم ملف الصورة أكثر من ',
            'price' => [
                'value' => $basePrice,
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
