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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email')->nullable()->unique();
            $table->string('mobile')->nullable()->unique();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('password')->nullable();
            $table->string('avater')->nullable();
            $table->boolean('status')->default(true);
            $table->date('date_of_birth');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
