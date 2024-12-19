<?php

use App\Models\OptionPostcardService;
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
        Schema::create('sub_option_postcard_services', function (Blueprint $table) {
            $table->id();
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('image');
            $table->integer('num_item_over')->default(0);
            $table->foreignIdFor(OptionPostcardService::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('sub_option_postcard_services');
    }
};
