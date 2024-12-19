<?php

use App\Models\PackgePosterService;
use App\Models\SubOptionPosterprintService;
use App\Models\User;
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
        Schema::create('poster_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PackgePosterService::class)->constrained()->cascadeOnDelete();
            $table->foreignId('print_choices_id')->constrained('sub_option_posterprint_services')->cascadeOnDelete();
            $table->foreignId('frame_choices_id')->constrained('sub_option_posterprint_services')->cascadeOnDelete();
            $table->foreignId('print_color_choices_id')->constrained('sub_option_posterprint_services')->cascadeOnDelete();
            $table->integer('copies');
            $table->integer('photo_num');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('poster_bookings');
    }
};
