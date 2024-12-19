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
            $table->enum('isAcceptable',['accept','wait','inAccept'])->default('wait')->after('id');
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
            $table->dropColumn('isAcceptable');
        });
    }
};
