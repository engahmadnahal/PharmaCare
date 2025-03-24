<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $discount = $this->retail_price - $this->basic_price;
        $relatedProducts = Product::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return [
            'id' => $this->id,
            'images' => [
                'main' => Storage::url($this->image),
                'leaflet' => Storage::url($this->medication_leaflet_image),
            ],
            'pricing' => [
                'basic_price' => (float) $this->basic_price,
                'retail_price' => (float) $this->retail_price,
                'discount' => abs($discount),
                'has_discount' => $discount > 0,
            ],
            'names' => [
                'trade_name' => $this->tradeName,
                'scientific_name' => $this->scientificName,
            ],
            'descriptions' => [
                'drug_description' => $this->drugDescription,
                'indications_for_use' => $this->indicationsForUse,
                'recommended_dosage' => $this->recommendedDosage,
                'how_to_use' => $this->howToUse,
            ],
            'medical_info' => [
                'drug_interactions' => $this->drugInteractions,
                'side_effects' => $this->sideEffects,
                'alternative_medicines' => $this->alternativeMedicines,
                'complementary_medicines' => $this->complementaryMedicines,
            ],
            'specifications' => [
                'concentration' => [
                    'value' => $this->concentration_value,
                    'unit' => $this->concentration_unit,
                ],
                'package_units' => $this->num_units_in_package,
                'weight' => $this->weight,
                'barcode' => $this->barcode,
            ],
            'availability' => [
                'quantity' => $this->quantity,
                'expiration_date' => $this->expiration_date,
                'available_without_prescription' => (bool) $this->available_without_prescription,
                'in_stock' => $this->quantity > 0,
            ],
            'classifications' => [
                'category' => [
                    'id' => $this->category?->id,
                    'name' => $this->category?->name,
                ],
                'medicine_type' => [
                    'id' => $this->medicineType?->id,
                    'name' => $this->medicineType?->name,
                ],
                'pharmaceutical' => [
                    'id' => $this->pharmaceutical?->id,
                    'name' => $this->pharmaceutical?->name,
                ],
            ],
            'user_interaction' => [
                'is_favorite' => (bool) $this->isFavorited,
                'rating' => [
                    'average' => round($this->rateProducts()->avg('rate'), 1) ?? 0,
                    'count' => $this->rateProducts()->count(),
                    'user_rating' => $this->rateProducts()->where('user_id', auth('user-api')->id())->first()?->rate ?? 0,
                ],
            ],
            'product_ratings' => ProductRateResource::collection($this->rateProducts),
            'related_products' => ProductResource::collection($relatedProducts),

        ];
    }
}
