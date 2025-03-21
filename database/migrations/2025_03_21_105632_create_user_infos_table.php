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
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('width');
            $table->string('length');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->boolean('is_allergies')->default(false);
            $table->boolean('is_genetic_diseases')->default(false);
            $table->enum('genetic_diseases', ['genetic', 'chronic', 'both'])->nullable();
            $table->enum('allergies', ['medication', 'food', 'both'])->nullable();
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
        Schema::dropIfExists('user_infos');
    }
};
