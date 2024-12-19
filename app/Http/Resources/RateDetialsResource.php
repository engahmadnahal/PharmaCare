<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RateDetialsResource extends JsonResource
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
            'user_name' => $this->order?->user?->name ?? '',
            'user_avater' => !is_null($this->order?->user?->avater) ? Storage::url($this->order->user->avater) : asset('assets/media/users/300_21.jpg'),
            'user_rate' => (string) $this->rate,
            'user_comment' => $this->comment,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
