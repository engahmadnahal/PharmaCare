<?php

use App\Models\ServiceStudio;
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
        Schema::table('passport_services', function (Blueprint $table) {
            $table->foreignIdFor(ServiceStudio::class)->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('postcard_services', function (Blueprint $table) {
            $table->foreignIdFor(ServiceStudio::class)->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('posterprint_services', function (Blueprint $table) {
            $table->foreignIdFor(ServiceStudio::class)->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('frame_album_services', function (Blueprint $table) {
            $table->foreignIdFor(ServiceStudio::class)->nullable()->constrained()->cascadeOnDelete();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passport_services', function (Blueprint $table) {
            $table->dropForeignIdFor(ServiceStudio::class);
        });

        Schema::table('postcard_services', function (Blueprint $table) {
            $table->dropForeignIdFor(ServiceStudio::class);
        });

        Schema::table('posterprint_services', function (Blueprint $table) {
            $table->dropForeignIdFor(ServiceStudio::class);
        });
        Schema::table('frame_album_services', function (Blueprint $table) {
            $table->dropForeignIdFor(ServiceStudio::class);
        });
    }
};
