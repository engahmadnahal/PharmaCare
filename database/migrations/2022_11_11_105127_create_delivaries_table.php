<?php

use App\Models\Region;
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
        Schema::create('delivaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('address');
            $table->string('national_id');
            $table->string('avater');
            $table->boolean('active');
            $table->foreignIdFor(Region::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('delivaries');
    }
};
