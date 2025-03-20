<?php

use App\Models\Category;
use App\Models\MedicineType;
use App\Models\StoreHouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MedicineType::class)->constrained()->cascadeOnDelete();
            $table->string('barcode')->unique()->comment('Barcode of the medicine');
            $table->string('trade_name_ar');
            $table->string('trade_name_en');
            $table->string('scientific_name_ar');
            $table->string('scientific_name_en');
            $table->string('drug_description_ar');
            $table->string('drug_description_en');
            $table->string('indications_for_use_ar');
            $table->string('indications_for_use_en');
            $table->string('recommended_dosage_ar');
            $table->string('recommended_dosage_en');
            $table->string('how_to_use_ar');
            $table->string('how_to_use_en');
            $table->string('drug_interactions_ar');
            $table->string('drug_interactions_en');
            $table->string('side_effects_ar');
            $table->string('side_effects_en');
            $table->string('alternative_medicines_ar');
            $table->string('alternative_medicines_en');
            $table->string('complementary_medicines_ar');
            $table->string('complementary_medicines_en');
            $table->string('concentration_value')->comment('concentration value of the medicine');
            $table->string('concentration_unit')->comment('concentration unit of the medicine');
            $table->integer('num_units_in_package')->comment('Number of units in the package');
            $table->boolean('available_without_prescription')->default(false)->comment('Available without a prescription');
            $table->integer('quantity')->comment('Quantity of the medicine');
            $table->integer('basic_price')->comment('Basic price of the medicine');
            $table->integer('retail_price')->comment('Retail price of the medicine');
            $table->date('expiration_date')->comment('Expiration date of the medicine');
            $table->string('image');
            $table->string('medication_leaflet_image')->comment('Medication leaflet image of the medicine');
            $table->integer('weight')->comment('Weight of the medicine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
