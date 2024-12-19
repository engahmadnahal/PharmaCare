<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StudioRateResource extends JsonResource
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
            'user_name' => $this->user?->name ?? '',
            'user_avater' => !is_null($this->user?->avater) ? Storage::url($this->user?->avater) : asset('assets/media/users/300_21.jpg'),
            'user_rate' => (string) $this->rate,
            'user_comment' => $this->comment,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
