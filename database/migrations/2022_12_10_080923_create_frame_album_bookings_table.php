<?php

use App\Models\AlbumSize;
use App\Models\FramesOrAlbum;
use App\Models\FramesSize;
use App\Models\QsFramesAlbum;
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
        Schema::create('frame_album_bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['frame','album']);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FramesOrAlbum::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FramesSize::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AlbumSize::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('quantity');
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
        Schema::dropIfExists('frame_album_bookings');
    }
};
