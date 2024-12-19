<?php

use App\Models\ServicesBookingStudio;
use App\Models\StudioBranch;
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
        Schema::create('services_booking_studio_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudioBranch::class)->constrained()->cascadeOnDelete();
            $table->foreignId('services_id')->constrained('services_booking_studios')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_booking_studio_branches');
    }
};
