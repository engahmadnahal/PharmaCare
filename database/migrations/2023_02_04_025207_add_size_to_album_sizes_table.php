<?php

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
        Schema::table('album_sizes', function (Blueprint $table) {
            $table->double('width')->default(0);
            $table->double('height')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('album_sizes', function (Blueprint $table) {
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
};
