<?php

use App\Models\StoreHouse;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StoreHouse::class)->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image');
            $table->enum('type',['user','studio']);
            $table->integer('num_items');
            $table->boolean('active');
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
        Schema::dropIfExists('products');
    }
};
