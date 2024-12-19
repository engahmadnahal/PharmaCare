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
        Schema::create('frames_sizes', function (Blueprint $table) {
            $table->id();
            $table->double('width');
            $table->double('height');
            // $table->double('price');
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
        Schema::dropIfExists('frames_sizes');
    }
};
