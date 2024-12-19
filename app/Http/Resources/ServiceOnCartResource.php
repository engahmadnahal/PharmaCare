<?php

namespace App\Http\Resources;

use App\Http\Resources\Cart\FrameResource;
use App\Http\Resources\Cart\PassportResource;
use App\Http\Resources\Cart\PostcartResource;
use App\Http\Resources\Cart\PosterResource;
use App\Http\Resources\Cart\ProductResource;
use App\Http\Resources\Cart\SoftcopyResource;
use App\Http\Resources\Cart\StudioResource;
use App\Models\FrameAlbumBooking;
use App\Models\PassportBooking;
use App\Models\PostcardBooking;
use App\Models\PosterBooking;
use App\Models\ProductBooking;
use App\Models\SoftcopyBooking;
use App\Models\StudioBooking;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOnCartResource extends JsonResource
{

    protected $total, $tax, $discount, $subtotal;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->getResource($this->type_object);
    }


    // $this->getResource($request)
    private function getResource($obj)
    {
        return match ($obj) {
            PosterBooking::class => new PosterResource($this),
            PostcardBooking::class => new PostcartResource($this),
            FrameAlbumBooking::class => new FrameResource($this),
            PassportBooking::class => new PassportResource($this),
            StudioBooking::class => new StudioResource($this),
            SoftcopyBooking::class => new SoftcopyResource($this),
            ProductBooking::class => new ProductResource($this),
        };
    }
}
