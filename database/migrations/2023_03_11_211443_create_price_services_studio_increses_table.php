<?php

use App\Models\Currency;
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
        Schema::create('price_services_studio_increses', function (Blueprint $table) {
            $table->id();
            $table->morphs('object');
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
        Schema::dropIfExists('price_services_studio_increses');
    }
};
