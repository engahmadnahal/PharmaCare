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
        Schema::create('user_medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name')->comment('The name of the medical record');
            $table->string('description')->comment('The description of the medical record');
            $table->string('type')->comment('select in enum disease, allergy, medication, immunization, lab_result, x_ray, other');
            $table->string('file')->nullable()->comment('The file of the medical record');
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
        Schema::dropIfExists('user_medical_records');
    }
};
