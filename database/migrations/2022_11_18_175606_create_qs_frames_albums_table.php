<?php

use App\Models\FramesOrAlbum;
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
        Schema::create('qs_frames_albums', function (Blueprint $table) {
            $table->id();
            $table->string('qs_ar');
            $table->string('qs_en');
            // $table->double('price')->default(0);
            $table->enum('type',['yesOrNo']);
            $table->foreignIdFor(FramesOrAlbum::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('qs_frames_albums');
    }
};
