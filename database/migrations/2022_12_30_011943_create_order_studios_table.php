<?php

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\StudioBranch;
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
        Schema::create('order_studios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StudioBranch::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(OrderStatus::class)->constrained()->cascadeOnDelete();
            $table->morphs('object');
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
        Schema::dropIfExists('order_studios');
    }
};
