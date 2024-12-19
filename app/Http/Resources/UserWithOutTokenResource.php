<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserWithOutTokenResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'date' => $this->created_at->diffForHumans(),
            'mobile' => $this->mobile,
            'avater' => $this->avater != null ? Storage::url($this->avater) : asset('media/users/300_21.jpg'),
        ];
    }
}
