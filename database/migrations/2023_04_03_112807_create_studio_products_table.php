<?php

use App\Models\Currency;
use App\Models\Product;
use App\Models\StudioBranch;
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
        Schema::create('studio_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudioBranch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Currency::class)->constrained()->cascadeOnDelete();
            $table->double('total_price'); // السعر الكلي بسعر الجملة وليس الذي ادخله الادمن
            $table->double('current_price'); // السعر الكلي او السعر الذي وضعه حازم وهو الذي سيستخدم
            $table->integer('amount');
            $table->double('price_elm');
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
        Schema::dropIfExists('studio_products');
    }
};
