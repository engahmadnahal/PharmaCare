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
        Schema::table('softcopy_bookings', function (Blueprint $table) {
            $table->string('note_admin_ar')->nullable()->after('id');
            $table->string('note_admin_en')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('softcopy_bookings', function (Blueprint $table) {
            $table->dropColumn('note_admin_ar');
            $table->dropColumn('note_admin_en');
        });
    }
};