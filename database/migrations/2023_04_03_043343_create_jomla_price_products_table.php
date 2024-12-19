<?php

use App\Models\Currency;
use App\Models\Product;
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
        Schema::create('jomla_price_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Currency::class)->constrained()->cascadeOnDelete();
            $table->double('price');
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
        Schema::dropIfExists('jomla_price_products');
    }
};
