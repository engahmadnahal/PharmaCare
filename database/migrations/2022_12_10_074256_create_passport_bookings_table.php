<?php

use App\Models\Country;
use App\Models\PassportCountry;
use App\Models\PassportType;
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
        Schema::create('passport_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PassportType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PassportCountry::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->longText('note')->nullable();;
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
        Schema::dropIfExists('passport_bookings');
    }
};
