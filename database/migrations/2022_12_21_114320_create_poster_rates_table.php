<?php

use App\Models\PosterBooking;
use App\Models\PosterprintService;
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
        Schema::create('poster_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PosterprintService::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PosterBooking::class)->constrained()->cascadeOnDelete();
            $table->integer('rate');
            $table->string('comment');
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
        Schema::dropIfExists('poster_rates');
    }
};
