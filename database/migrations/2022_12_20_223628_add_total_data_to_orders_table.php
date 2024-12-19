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
        Schema::table('orders', function (Blueprint $table) {
            $table->double('subtotal');
            $table->double('total');
            $table->double('tax');
            $table->double('discount');
            $table->double('delivery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('subtotal');
            $table->dropColumn('total');
            $table->dropColumn('tax');
            $table->dropColumn('discount');
            $table->dropColumn('delivery');
        });
    }
};
