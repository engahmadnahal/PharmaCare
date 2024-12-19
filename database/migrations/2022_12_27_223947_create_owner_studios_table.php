<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
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
        Schema::create('owner_studios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Region::class)->constrained()->cascadeOnDelete();
            $table->string('fname');
            $table->string('lname');
            $table->string('national_id');
            $table->string('mobile');
            $table->string('email');
            $table->string('password');
            $table->string('address');
            $table->boolean('active')->default(true);
            $table->string('avater')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('owner_studios');
    }
};
