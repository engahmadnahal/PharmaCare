<?php

namespace App\Http\Resources\Order;

use App\Models\SoftcopyConfirm;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'order_details' => [
                'id' => $this->id,
                'is_softcopy' => (bool) $this->isSoftCopy,
                'isConfirmSoftcopy' => $this->isSoftCopy ? $this->isConfirmSoftCopy() : false,
                'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
                'order_num' => $this->order_num,
                'price' => [
                    'value' => (double) $this->cost,
                    'currency' => $this->currency->code
                ],
                'payment' => $this->payment_way,
                'receipt_type' => $this->receiving,
                'isSendToStduio' => (bool) $this->isSendToStduio,
                'studio_details' => [
                    'id' => $this->studioSendOrder?->id ?? 0,
                    'name' => $this->studioSendOrder?->name ?? "",
                    'latidute' =>  $this->studioSendOrder?->latidute ?? 0.5,
                    'longitude' =>  $this->studioSendOrder?->longitude ?? 0.5,
                    'address' =>  $this->studioSendOrder?->address ?? "",
                ],
                'receipt_ar' => $this->receiving == 'delivery' ? 'التسليم في عنوان العميل' : 'أقرب مركز طباعة',
                'receipt_en' => $this->receiving == 'delivery' ? 'Delivery at customer address' : 'Nearest print center',
                'receipt_print_center' => $this->studioSendOrder?->address ?? "",
                'receipt_delivary_address' => $this->userAddress?->fullAddress ?? "",
                'date_of_receipt' => [
                    'title_ar' => $this->date?->qs_ar ?? "",
                    'title_en' => $this->date?->qs_en ?? "",
                    'price' => [
                        'value' => $this->date?->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0,
                        'currency' => $this->date?->price->where('currency_id', auth()->user()->currency)->first()?->currency->code ?? 0,
                    ],
                ],
                'user_info' => [
                    'name' => $this->username,
                    'mobile' => $this->usermobile,
                ],
                'order_status' => new OrderStatusResource($this->orderStatus),
                
            ],
            'answer_qs_general' => AnswerGenerakResource::collection($this->answerGeneralQs->where('pivot.answer','yes')),
            'total_detials' => [
                'tax' => $this->tax,
                'subtotal' => $this->subtotal,
                'discounts' => $this->discount,
                'delivery' => $this->delivery,
                'total' => $this->cost
            ],
            'services' => $this->services
        ];
    }

    private function isConfirmSoftCopy(){
        return SoftcopyConfirm::where('softcopy_booking_id',$this->softcopy_booking_id)->exists();
    }
}
