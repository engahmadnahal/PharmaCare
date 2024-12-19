<?php

use App\Models\PassportCountry;
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
        Schema::table('passport_options', function (Blueprint $table) {
            $table->foreignIdFor(PassportCountry::class)->after('passport_type_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passport_options', function (Blueprint $table) {
            $table->dropForeignIdFor(PassportCountry::class);
        });
    }
};
