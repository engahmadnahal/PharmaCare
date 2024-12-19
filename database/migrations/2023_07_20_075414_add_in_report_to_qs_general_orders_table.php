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
        Schema::table('qs_general_orders', function (Blueprint $table) {
            $table->string('in_report')->after('qs_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qs_general_orders', function (Blueprint $table) {
            $table->dropColumn('in_report');
        });
    }
};
