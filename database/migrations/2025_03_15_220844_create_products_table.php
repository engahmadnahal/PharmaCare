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
            $table->longText('drug_description_ar');
            $table->longText('drug_description_en');
            $table->longText('indications_for_use_ar');
            $table->longText('indications_for_use_en');
            $table->longText('recommended_dosage_ar');
            $table->longText('recommended_dosage_en');
            $table->longText('how_to_use_ar');
            $table->longText('how_to_use_en');
            $table->longText('drug_interactions_ar');
            $table->longText('drug_interactions_en');
            $table->longText('side_effects_ar');
            $table->longText('side_effects_en');
            $table->longText('alternative_medicines_ar');
            $table->longText('alternative_medicines_en');
            $table->longText('complementary_medicines_ar');
            $table->longText('complementary_medicines_en');
            $table->string('concentration_value')->comment('concentration value of the medicine');
            $table->string('concentration_unit')->comment('concentration unit of the medicine');
            $table->integer('num_units_in_package')->comment('Number of units in the package');
            $table->boolean('available_without_prescription')->default(false)->comment('Available without a prescription');
            $table->integer('quantity')->comment('Quantity of the medicine');
            $table->integer('basic_price')->comment('Basic price of the medicine');
            $table->integer('retail_price')->comment('Retail price of the medicine');
            $table->date('expiration_date')->comment('Expiration date of the medicine');
            $table->string('image')->comment('Image of the medicine');
            $table->string('medication_leaflet_image')->nullable()->comment('Medication leaflet image of the medicine');
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
