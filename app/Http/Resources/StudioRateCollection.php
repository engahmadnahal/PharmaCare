<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudioRateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'overal_rate' => number_format($this->collection['std']->overal_rate ?? 0,2),
            'rates' => StudioRateResource::collection($this->collection['data']),
            'pagination' => [
                'next_page_url' => $this['data']->nextPageUrl(),
                'total' => $this['data']->total(),
                'count' => $this['data']->count(),
                'per_page' => $this['data']->perPage(),
                'current_page' => $this['data']->currentPage(),
                'total_pages' => $this['data']->lastPage(),
            ],

        ];
    }
}
