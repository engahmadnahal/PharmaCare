<?php

use App\Models\FrameAlbumBooking;
use App\Models\FrameAlbumService;
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
        Schema::create('frame_album_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FrameAlbumService::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FrameAlbumBooking::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('frame_album_rates');
    }
};
