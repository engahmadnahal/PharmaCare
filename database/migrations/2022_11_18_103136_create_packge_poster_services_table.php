<?php

use App\Models\OptionPosterprintService;
use App\Models\PosterprintService;
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
        Schema::create('packge_poster_services', function (Blueprint $table) {
            $table->id();
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('image');
            $table->double('num_item_over')->default(0);
            $table->foreignIdFor(OptionPosterprintService::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**_create_sub_option_posterprint_services_table
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packge_poster_services');
    }
};
