<?php

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
        Schema::create('booking_studio_services', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->double('overal_rate')->default(0);
            $table->string('about_ar');
            $table->string('about_en');
            $table->string('poster');
            $table->json('slider_images');
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
        Schema::dropIfExists('booking_studio_services');
    }
};
