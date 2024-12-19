<?php

use App\Models\Currency;
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
        Schema::table('postcard_bookings', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->double('total')->nullable();
        });

        Schema::table('passport_bookings', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->double('total')->nullable();
        });

        Schema::table('frame_album_bookings', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->double('total')->nullable();
        });


        Schema::table('poster_bookings', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->after('id')->constrained()->cascadeOnDelete();
            $table->double('total')->nullable();
        });


        Schema::table('studio_bookings', function (Blueprint $table) {
            $table->foreignIdFor(Currency::class)->nullable()->constrained()->cascadeOnDelete();
            $table->double('total')->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postcard_bookings', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropForeignIdFor(Currency::class);
        });

        Schema::table('passport_bookings', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropForeignIdFor(Currency::class);
        });

        Schema::table('frame_album_bookings', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropForeignIdFor(Currency::class);
        });

        Schema::table('poster_bookings', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropForeignIdFor(Currency::class);
        });
        
        Schema::table('studio_bookings', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropForeignIdFor(Currency::class);
        });
        
       
    }
};
