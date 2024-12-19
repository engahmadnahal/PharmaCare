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
        Schema::table('services_booking_studios', function (Blueprint $table) {
            $table->integer('num_add')->after('id');
            $table->integer('num_photo')->after('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_booking_studios', function (Blueprint $table) {
            $table->dropColumn('num_add');
            $table->dropColumn('num_photo');
        });
    }
};
