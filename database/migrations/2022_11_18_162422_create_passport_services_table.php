<?php

use App\Models\Country;
use App\Models\PassportType;
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
        Schema::create('passport_services', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            // $table->string('description_en');
            // $table->string('description_ar');
            $table->double('overal_rate')->default(0);
            $table->string('poster');
            $table->json('slider_images');
            // $table->integer('num_photo');
            // $table->double('price_elm');
            // $table->integer('num_add');
            // $table->boolean('isNote')->default(false);
            // $table->string('note')->nullable()->nullable();
            // $table->foreignIdFor(PassportType::class)->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->boolean('active');
            $table->boolean('soon');
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
        Schema::dropIfExists('passport_services');
    }
};
