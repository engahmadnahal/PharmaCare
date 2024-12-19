<?php

use App\Models\City;
use App\Models\Country;
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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('details');
            $table->boolean('isDefault')->default(false);
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
        Schema::dropIfExists('user_addresses');
    }
};
