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
        Schema::create('pharmaceuticals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('pharmaceuticals')->cascadeOnDelete();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('phone')->unique();
            $table->string('commercial_register');
            $table->string('tax_number');
            $table->string('type');
            $table->boolean('has_branch')->default(false);
            $table->foreignIdFor(Country::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(City::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Region::class)->constrained()->nullOnDelete();
            $table->string('address');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('pharmaceuticals');
    }
};
