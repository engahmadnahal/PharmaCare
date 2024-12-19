<?php

use App\Models\BookingStudioService;
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
            $table->foreignIdFor(BookingStudioService::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
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
            $table->dropForeignIdFor(BookingStudioService::class);
        });
    }
};
