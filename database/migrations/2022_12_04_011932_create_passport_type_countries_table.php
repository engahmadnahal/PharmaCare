<?php

use App\Models\Country;
use App\Models\PassportCountry;
use App\Models\PassportType;
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
        Schema::create('passport_type_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PassportType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PassportCountry::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('passport_type_countries');
    }
};
