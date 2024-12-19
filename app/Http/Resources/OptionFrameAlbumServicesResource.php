<?php

namespace App\Http\Resources;

use App\Models\AlbumSize;
use App\Models\FramesSize;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OptionFrameAlbumServicesResource extends JsonResource
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
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'image' => Storage::url($this->image),
            'price' => $this->price,
            'options' => $this->subOptions->map(function($subOption){
                return [
                    'id' => $subOption->id,
                    'type' => $subOption->type,
                    'title' => $subOption->title,
                    'title_ar' => $subOption->title_ar,
                    'title_en' => $subOption->title_en,
                    'note' => $subOption->note,
                    'note_ar' => $subOption->note_ar,
                    'note_en' => $subOption->note_en,
                    'description' => $subOption->description,
                    'description_ar' => $subOption->description_ar,
                    'description_en' => $subOption->description_en,
                    'image' => Storage::url($subOption->image),
                    'price' => $subOption->price,
                    'sizes' => $this->optionsSizeOrNumAlbum($subOption->type,$subOption->id),
                ];
            })
        ];;
    }

    public function optionsSizeOrNumAlbum($type,$id){

        if($type == "frame"){
            $data = FramesSize::where('frames_or_album_id',$id)->get();
            if($data->count() == 0){
                return [];
            }
            return $data->map(function($e){
                return [
                    "id" => $e->id,
                    "width" => $e->width,
                    "height" => $e->height,
                    "price" => $e->price,
                ];
            });
        }else{
            $data = AlbumSize::where('frames_or_album_id',$id)->get();
            if($data->count() == 0){
                return [];
            }
            return $data->map(function($e){
                return [
                    "id" => $e->id,
                    "num_photo" => $e->num_photo,
                    "price" => $e->price,
                ];
            });
        }
    }
}
