<?php

use App\Models\OptionFrameAlbumService;
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
        Schema::create('frames_or_albums', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('note_ar');
            $table->string('note_en');
            $table->string('description_en');
            $table->string('description_ar');
            $table->string('image');
            // $table->double('price')->default(0);
            $table->enum('type',['frame','album']);
            $table->foreignIdFor(OptionFrameAlbumService::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('frames_or_albums');
    }
};
