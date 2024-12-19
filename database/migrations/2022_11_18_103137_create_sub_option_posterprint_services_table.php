<?php

use App\Models\OptionPosterprintService;
use App\Models\PackgePosterService;
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
        Schema::create('sub_option_posterprint_services', function (Blueprint $table) {
            $table->id();
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('image');
            // $table->double('price')->default(0);
            $table->boolean('isPrice')->default(0);
            // $table->foreignId('package_id')->constrained('packge_poster_services')->cascadeOnDelete();
            $table->foreignIdFor(PackgePosterService::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('sub_option_posterprint_services');
    }
};
