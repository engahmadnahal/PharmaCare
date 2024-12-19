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
        Schema::table('passport_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });

        Schema::table('postcard_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });

        Schema::table('posterprint_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });

        Schema::table('frame_album_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });

        Schema::table('soft_copy_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });

        Schema::table('booking_studio_services', function (Blueprint $table) {
            $table->double('tax')->after('id')->default(0);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passport_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        Schema::table('postcard_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        Schema::table('posterprint_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        Schema::table('frame_album_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        Schema::table('soft_copy_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        Schema::table('booking_studio_services', function (Blueprint $table) {
            $table->dropColumn('tax');
        });

        
        
        
    }
};
