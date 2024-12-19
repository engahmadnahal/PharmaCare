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
        Schema::table('packge_poster_services', function (Blueprint $table) {
            //
            $table->integer('min_size_image')->after('id');
            $table->enum('type_size',['KB','MG'])->after('min_size_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packge_poster_services', function (Blueprint $table) {
            //
            $table->dropColumn('min_size_image');
            $table->dropColumn('type_size');
        });
    }
};
