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
        Schema::table('studio_branches', function (Blueprint $table) {
            $table->string('description_en');
            $table->string('description_ar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studio_branches', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_ar');
        });
    }
};
