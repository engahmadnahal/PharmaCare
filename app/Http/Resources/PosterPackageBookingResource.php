<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PosterPackageBookingResource extends JsonResource
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
                'print_choices_id' => $this->bookingUser?->print_choices_id,
                'frame_choices_id' => $this->bookingUser?->frame_choices_id,
                'print_color_choices_id' => $this->bookingUser?->print_color_choices_id,
                'copies' => $this->bookingUser?->copies,
                'photo_num' => $this->bookingUser?->photo_num,
                'note' => $this->bookingUser?->note,
                'images' => !is_null($this->bookingUser?->images) ? ImageResource::collection($this->bookingUser?->images) : []
            ]),
            'id' => $this->id,
            'title_ar' => "طباعة ملصق ({$this->size->title_ar})",
            'title_en' => "Poster Printing ({$this->size->title_en})",
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'image' => Storage::url($this->image),
            'max_item' => intval($this->num_item_over),
            'min_item' => $this->min_item,
            'discount_value' => $this->discount_value  / 100,
            'delivaly_value' => doubleval(0),
            'tax' => $this->size->service->is_tax ? $this->taxValue / 100 : 0,
            'size_to_byte' => $this->calcToByte($this->type_size,$this->min_size_image),
            'note_en' => 'Note: The image file size is more than '.$this->min_size_image .''.$this->type_size,
            'note_ar' => $this->min_size_image .''.$this->type_size.' ملاحظة: حجم ملف الصورة أكثر من ',
            'price' => [
                'value' => $this->price->where('currency_id',auth()->user()->currency)->first()?->price ?? 0,
                'currency' => $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code,
            ],
            'print_choices' => PrintOptionPackagePosterResource::collection($this->options->where('type','print')),
            'frame_choices' => FrameOptionPackagePosterResource::collection($this->options->where('type','frame')),
            'print_color_choices' => PrintColorOptionPackagePosterResource::collection($this->options->where('type','printColor')),
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
