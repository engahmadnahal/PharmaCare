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
        Schema::create('qs_general_orders', function (Blueprint $table) {
            $table->id();
            $table->string('qs_ar');
            $table->string('qs_en');
            $table->enum('type',['yesOrNo'])->default('yesOrNo');
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
        Schema::dropIfExists('qs_general_orders');
    }
};
