<?php

namespace App\Http\Resources\Cart;

use App\Models\AlbumSize;
use App\Models\FramesSize;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrameResource extends JsonResource
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
            'type' => 'frameOrAlbum',
            'isRate' => $this->isRate,
            'rate' => $this->rate,
            'title_ar' => $this->frameOrAlbum->title_ar,
            'title_en' => $this->frameOrAlbum->title_en,
            'description_ar' => $this->frameOrAlbum->description_ar,
            'description_en' => $this->frameOrAlbum->description_en,
            'people_num' => null,
            'copies' => null,
            'photo_num' => null,
            'quantity' => $this->quantity,
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

    private function getSizePrice($obj,$sizeType){
        if($sizeType == 'frame'){
            $size = FramesSize::find($obj->frames_size_id);
        }else{
            $size = AlbumSize::find($obj->album_size_id);
        }
        $price = $size->price->where('currency_id',auth()->user()->currency)->first()?->price;
        return $price;
    }

    private function getSizeChoiceId($obj,$sizeType){
        if($sizeType == 'frame'){
            $sizeId = $obj->frames_size_id;
        }else{
            $sizeId = $obj->album_size_id;
        }
        return $sizeId;
    }
    
}
