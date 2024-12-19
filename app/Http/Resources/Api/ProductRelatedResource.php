<?php

namespace App\Http\Resources\Api;

use App\Helpers\DayService;
use App\Models\DayTranslation;
use App\Models\FavoriteProduct;
use App\Models\Language;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductRelatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $reqLang = request()->header('lang') ?? 'ar';
        $selLang = Language::where('code',$reqLang)->first();
        return [
            'productId' => $this->id,
            'name' => $this->product->translations->where('language_id',$selLang->id)->first()->name ?? 'no translation',
            'about' => $this->product->translations->where('language_id',$selLang->id)->first()->about ?? 'no translation',
            'unit' => $this->product->unit->translations->where('language_id',$selLang->id)->first()->name ?? 'no translation',
            'unit_value' => $this->product->unit_value,
            'overal_rate' => $this->overal_rate, // calc
            'price' => $this->price,
            'image' => Storage::url($this->product->image),
            'view' => $this->view,
            'barcode' => $this->product->barcode,
            'reviews' => $this->reatings->count(),
            'isFavorite' => $this->isFavorite($this->product_id),
            'compony' => $this->product->trade->company->name,
            'trade_mark' => [
                'name' =>$this->product->trade->name,
                'country' => $this->product->trade->company->country->name
            ],
            'store' => [
                'id' => $this->store->id,
                'name' => $this->store->name,
                'isOpen' => $this->statusStore($this->store)
            ],
        ];
    }

    public function statusStore(Store $store) : bool{
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

    public function isFavorite($id) : bool{
        $isFav = FavoriteProduct::where('user_id',auth()->user()->id)->where('store_product_id',$id)->exists();
        return $isFav;
    }
}
