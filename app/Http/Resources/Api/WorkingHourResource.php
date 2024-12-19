<?php

namespace App\Http\Resources\Api;

use App\Helpers\DayService;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHourResource extends JsonResource
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
            'isToday' => $this->day->id == DayService::now(),
            'id' => $this->id,
            'name' => $this->day->name_api,
            'from' => date('h:i a', strtotime($this->start_time)),
            'to' => date('h:i a', strtotime($this->close_time)),
            'note' => $this->translations->first()->note ?? 'no notes'
        ];
    }
}
