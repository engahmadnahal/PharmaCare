<?php

use App\Models\AlbumSize;
use App\Models\FramesSize;
use App\Models\QsFramesAlbum;
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
        Schema::create('size_qs_frame_albumes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FramesSize::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AlbumSize::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(QsFramesAlbum::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('size_qs_frame_albumes');
    }
};
