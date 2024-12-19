<?php

use App\Models\ServiceStudio;
use App\Models\Studio;
use App\Models\StudioBranch;
use App\Models\StudioService;
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
        Schema::create('studio_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudioBranch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceStudio::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('studio_services');
    }
};
