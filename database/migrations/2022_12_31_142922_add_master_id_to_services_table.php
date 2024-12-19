<?php

use App\Models\FrameAlbumService;
use App\Models\PassportService;
use App\Models\PostcardBooking;
use App\Models\PostcardService;
use App\Models\PosterprintService;
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
        Schema::table('passport_bookings', function (Blueprint $table) {
            $table->foreignIdFor(PassportService::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        Schema::table('postcard_bookings', function (Blueprint $table) {
            $table->foreignIdFor(PostcardService::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        Schema::table('poster_bookings', function (Blueprint $table) {
            $table->foreignIdFor(PosterprintService::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
        });

        Schema::table('frame_album_bookings', function (Blueprint $table) {
            $table->foreignIdFor(FrameAlbumService::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passport_bookings', function (Blueprint $table) {
            $table->dropForeignIdFor(PassportService::class);
        });

        Schema::table('postcard_bookings', function (Blueprint $table) {
            $table->dropForeignIdFor(PassportService::class);
        });

        Schema::table('poster_bookings', function (Blueprint $table) {
            $table->dropForeignIdFor(PassportService::class);
        });

        Schema::table('frame_album_bookings', function (Blueprint $table) {
            $table->dropForeignIdFor(PassportService::class);
        });
    }
};
