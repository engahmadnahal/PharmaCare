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
            $table->boolean('block')->default(false)->after('id');
            $table->string('reson_block')->nullable()->after('block');
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
            $table->dropColumn(['block','reson_block']);
        });
    }
};
