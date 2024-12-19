<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosterChoicePackageResource extends JsonResource
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
            'print_choices' => PrintOptionPackagePosterResource::collection($this->options->where('type','print')),
            'frame_choices' => FrameOptionPackagePosterResource::collection($this->options->where('type','frame')),
            'print_color_choices' => PrintColorOptionPackagePosterResource::collection($this->options->where('type','printColor')),
        ];
    }
}
