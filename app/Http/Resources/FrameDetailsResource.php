<?php

namespace App\Http\Resources;

use App\Models\AlbumSize;
use App\Models\FramesSize;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrameDetailsResource extends JsonResource
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
            'user_booking' => $this->when(!is_null($this->bookingUser), [
                'frames_size_id' => $this->bookingUser?->frames_size_id,
                'album_size_id' => $this->bookingUser?->album_size_id,
                'quantity' => $this->bookingUser?->quantity,
                'images' => !is_null($this->bookingUser?->images) ? ImageResource::collection($this->bookingUser?->images) : []
            ]),
            'id' => $this->id,
            'tax' => $this->taxValue / 100,
            'discount_value' => $this->discount_value  / 100,
            'type' => $this->type,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'note_ar' => $this->note_ar,
            'note_en' => $this->note_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'image' => Storage::url($this->image),
            'slider_images' => $this->sliderImage(json_decode($this->slider_image)),
            'size_to_byte' => $this->calcToByte($this->type_size, $this->min_size_image),
            'note_app_en' => 'Note: The image file size is more than ' . $this->min_size_image . '' . $this->type_size,
            'note_app_ar' => $this->min_size_image . '' . $this->type_size . ' ملاحظة: حجم ملف الصورة أكثر من ',
            'question' => QsFrameResource::collection($this->qs),
            'sizes' => $this->optionsSizeOrNumAlbum($this->type, $this->id),
        ];
    }
    private function calcToByte($type, $size)
    {
        if ($type == 'MB') {
            return $this->calcMBToByte($size);
        } else if ($type == 'KB') {
            return $this->calcKBToByte($size);
        }
        return 0;
    }
    public function sliderImage($imgs)
    {
        $data = [];
        foreach ($imgs as $img) {
            $data[] = Storage::url($img);
        }
        return $data;
    }
    private function calcKBToByte($size)
    {
        // 1 kb == 1000
        return $size * 1000;
    }

    private function calcMBToByte($size)
    {
        // 1 mg == 1000000
        return $size * 1000000;
    }

    public function optionsSizeOrNumAlbum($type, $id)
    {

        if ($type == "frame") {
            $data = FramesSize::where('frames_or_album_id', $id)->get();
            if ($data->count() == 0) {
                return [];
            }
            return $data->map(function ($e) {
                return [
                    "id" => $e->id,
                    "width" => (string) $e->width,
                    "height" => (string)  $e->height,
                    'stock' => $e->product?->num_items ?? 0,
                    'price' => [
                        'value' => $e->product?->priceKey ?? 0,
                        'currency' => $e->product?->currencyKey ?? '',
                    ],
                    'qs_price' => [
                        'id' => $e->qsSize?->id,
                        'qs_ar' => $e->qsSize?->qs?->qs_ar ?? "",
                        'qs_en' => $e->qsSize?->qs?->qs_en ?? "",
                        'price' => [
                            'value' => $e->qsSize?->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0,
                            'currency' => $e->qsSize?->price->where('currency_id', auth()->user()->currency)->first()?->currency->code ?? "",
                        ],
                    ]
                ];
            });
        } else {
            $data = AlbumSize::where('frames_or_album_id', $id)->get();
            if ($data->count() == 0) {
                return [];
            }
            return $data->map(function ($e) {
                return [
                    "id" => $e->id,
                    "width" => (string) $e->width,
                    "height" => (string)  $e->height,
                    'stock' => $e->product?->number_items ?? 0,
                    'price' => [
                        'value' => $e->product?->priceKey ?? 0,
                        'currency' => $e->product?->currencyKey ?? '',
                    ],
                    'qs_price' => [
                        'id' => $e->qsSize?->id,
                        'qs_ar' => $e->qsSize?->qs?->qs_ar ?? "",
                        'qs_en' => $e->qsSize?->qs?->qs_en ?? "",
                        'price' => [
                            'value' => $e->qsSize?->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0,
                            'currency' => $e->qsSize?->price->where('currency_id', auth()->user()->currency)->first()?->currency->code ?? "",
                        ],
                    ]
                ];
            });
        }
    }
}
