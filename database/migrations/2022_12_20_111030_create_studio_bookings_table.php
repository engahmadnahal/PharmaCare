<?php

use App\Models\ServicesBookingStudio;
use App\Models\StudioBranch;
use App\Models\User;
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
        Schema::create('studio_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignId('studio_id')->constrained('studio_branches')->cascadeOnDelete();
            $table->foreignIdFor(ServicesBookingStudio::class)->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('time_from');
            $table->string('note')->nullable();
            $table->integer('qty');
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
        Schema::dropIfExists('studio_bookings');
    }
};
