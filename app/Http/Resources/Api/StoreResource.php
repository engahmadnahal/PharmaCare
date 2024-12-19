<?php

namespace App\Http\Resources\Api;

use App\Helpers\DayService;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $dayWork = $this->dayWorks->where('day_id', DayService::now())->first();
        $start = !is_null($dayWork) ? date('h:i a',strtotime($dayWork->start_time)) : 'No Work Time';
        $close = !is_null($dayWork) ? date('h:i a',strtotime($dayWork->close_time)) : '';
        $address = $this->translations->first()?->address;

        return [
            'id' => $this->id,
            'name' => $this->translations->first()->name ?? 'no translations',
            'overal_rate' => $this->overal_rate ?? 0,
            'reviewer' => $this->rates->count(),
            'logo' => Storage::url($this->logo),
            'cover_image' => Storage::url($this->cover),
            'isDelivary' => boolval($this->isDelivary),
            'type' => $this->type,
            'full_region' => $this->region->name .' - ' . $this->translations->first()?->address ?? 'no translations',
            'address' =>  $this->translations->first()?->address ?? 'no translations',
            
            'store_category' => $this->storeCategory->title,
            'about' => $this->translations->first()?->note ?? 'no translations',
            'preparing' => null,
            'region' => [
                'id' => $this->region->id,
                'name' => $this->region->name
            ],
            'delivary_price' => $this->delivaryPrice->map(function($d){
                return [
                    'name' => $d->region->name,
                    'price' => $d->price,
                    'full_duration' =>  $d->price . '$(' . $d->duration_num . Str::upper($d->duration_type[0]) . '/' . $d->region->name  .   ')',
                    'duration_num' => $d->duration_num,
                    'duration_type' => $d->duration_type
                ];
            }),
            'today_working_hour' => [
                'full' => $start . ' - ' . $close,
                'from' => $start,
                'to' => $close,
            ],
            // 'working_hour' => [
                
            // ],
            'isOpen' => $this->statusStore($this->id),
        ];
    }

    public function statusStore($id) : bool{
       $store = Store::find($id);
        $todayStore = $store->dayWorks->where('day_id',DayService::now())->first();
        if(is_null($todayStore)){
            return false;   
        }
        $start = $todayStore->start_time;
        $close = $todayStore->close_time;
        $time_now = Carbon::now();

        if($time_now->gt($start) && $time_now->lt($close)){
            return true;
        }
        return false;
    }


    

}
