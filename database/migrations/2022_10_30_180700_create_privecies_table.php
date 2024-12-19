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
        Schema::create('privecies', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title_ar');
            $table->string('title_en');
            $table->longText('body_ar');
            $table->longText('body_en');
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
        Schema::dropIfExists('privecies');
    }
};
