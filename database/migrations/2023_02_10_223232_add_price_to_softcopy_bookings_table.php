<?php

use App\Models\Currency;
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
            $table->foreignIdFor(Currency::class)->nullable()->constrained()->cascadeOnDelete();
            $table->double('price')->after('id')->nullable();
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
            $table->dropColumn('price');
            $table->dropForeign(Currency::class);
        });
    }
};
