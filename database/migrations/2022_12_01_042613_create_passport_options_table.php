<?php

use App\Models\Country;
use App\Models\PassportService;
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
        Schema::create('passport_options', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('description_en');
            $table->string('description_ar');
            $table->integer('num_photo');
            $table->integer('num_add');
            $table->foreignIdFor(PassportType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PassportService::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('passport_options');
    }
};
