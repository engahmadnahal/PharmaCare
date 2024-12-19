<?php

use App\Models\City;
use App\Models\Region;
use App\Models\Studio;
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
        Schema::create('studio_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('address');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->string('avater')->nullable();
            $table->string('longitude');
            $table->string('latidute');
            $table->timestamp('last_login')->nullable();
            $table->enum('type',['branch','main']);
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Region::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Studio::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('studio_branches');
    }
};
