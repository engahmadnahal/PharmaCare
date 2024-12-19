<?php

use App\Models\OwnerStudio;
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
        Schema::table('studios', function (Blueprint $table) {
            $table->foreignIdFor(OwnerStudio::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('studios')->cascadeOnDelete();
            $table->enum('type',['main','branch']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studios', function (Blueprint $table) {
            $table->dropForeignIdFor(OwnerStudio::class);
            $table->dropIndex('studios_parent_id_foreign');
            $table->dropColumn('parent_id');
            $table->dropColumn('type');

        });
    }
};
