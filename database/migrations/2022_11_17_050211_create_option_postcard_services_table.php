<?php

use App\Models\PostcardService;
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
        Schema::create('option_postcard_services', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('image');
            $table->double('width');
            $table->double('height');
            // $table->double('price')->default(0);
            $table->boolean('active');
            $table->foreignIdFor(PostcardService::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('option_postcard_services');
    }
};
