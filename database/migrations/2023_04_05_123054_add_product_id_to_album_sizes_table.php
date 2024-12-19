<?php

use App\Models\Product;
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
        Schema::table('album_sizes', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->after('id')->nullable()->constrained()->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('album_sizes', function (Blueprint $table) {
            $table->dropForeignIdFor(Product::class);
            
        });
    }
};
