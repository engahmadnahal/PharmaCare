<?php

use App\Models\Order;
use App\Models\StudioBranch;
use App\Models\User;
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
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->double('amount');
            $table->enum('status',['success','wait','cancel','failure'])->default('wait');
            $table->string('resultIndicator')->nullable();
            $table->string('sessionVersion')->nullable();
            $table->string('checkoutVersion')->nullable();
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
        Schema::dropIfExists('payment_orders');
    }
};
