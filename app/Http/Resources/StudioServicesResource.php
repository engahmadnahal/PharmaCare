<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudioServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $basePrice = $this->price_key ?? 0;
        $pricePhotoAfterIncrse = $this->priceAfterIncresKey ?? 0;
        $price = ($basePrice * 0.5) - $pricePhotoAfterIncrse;

        return [
            "id" =>  intval($this->id),
            "name_en" => $this->title_en,
            "name_ar" => $this->title_ar,
            'num_photo' => intval($this->num_photo), // عدد الصور
            'num_add' => intval($this->num_add), // مقدار الاضافة على عدد الصور ، بعد الحد المسموح
            'value_price_after_increase' => number_format($pricePhotoAfterIncrse,2,'.',''), // قيمة الخصم الاساسية بدون اي معادلة€€
            'result_price_after_increase' => number_format($price,2,'.',''), // الناتج بعد المعادلة
            'price' => [
                'value' => $this->price_key ?? 0,
                'currency' => $this->price_code ?? "",
            ],
        ];
    }
}
