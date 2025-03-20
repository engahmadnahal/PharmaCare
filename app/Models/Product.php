<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function medicineType()
    {
        return $this->belongsTo(MedicineType::class);
    }


   
    public function tradeName(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->trade_name_ar : $this->trade_name_en);
    }

    public function scientificName(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->scientific_name_ar : $this->scientific_name_en);
    }

    public function drugDescription(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->drug_description_ar : $this->drug_description_en);
    }

    public function indicationsForUse(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->indications_for_use_ar : $this->indications_for_use_en);
    }

    public function recommendedDosage(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->recommended_dosage_ar : $this->recommended_dosage_en);
    }

    public function howToUse(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->how_to_use_ar : $this->how_to_use_en);
    }

    public function drugInteractions(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->drug_interactions_ar : $this->drug_interactions_en);
    }

    public function sideEffects(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->side_effects_ar : $this->side_effects_en);
    }

    public function alternativeMedicines(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->alternative_medicines_ar : $this->alternative_medicines_en);
    }

    public function complementaryMedicines(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->complementary_medicines_ar : $this->complementary_medicines_en);
    }
}
