<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerGenerakResource extends JsonResource
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
            'title_ar' => $this->qs_ar,
            'title_en' => $this->qs_en,
            'type' => 'yesOrNo',
            'answer' => $this->pivot->answer,
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
        ];
    }
}
