<?php

use App\Models\PaymentGatWay;
use App\Models\SoftcopyBooking;
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
        Schema::create('softcopy_confirms', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_mobile');
            $table->foreignIdFor(SoftcopyBooking::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PaymentGatWay::class)->nullable()->constrained()->cascadeOnDelete();
            $table->double('total_booking')->nullable();
            $table->double('total_recive')->nullable();
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
        Schema::dropIfExists('softcopy_confirms');
    }
};
