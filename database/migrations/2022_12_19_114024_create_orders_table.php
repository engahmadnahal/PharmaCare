<?php

use App\Models\Coupon;
use App\Models\OrderStatus;
use App\Models\QsDateOrder;
use App\Models\User;
use App\Models\UserAddress;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num');
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Coupon::class)->nullable()->constrained()->nullOnDelete();
            $table->double('coupon_discount')->default(0);
            $table->double('shipping')->default(0);
            $table->double('subtotal')->default(0);
            $table->double('total')->default(0);
            $table->double('discount')->default(0);
            $table->string('note')->nullable();
            $table->enum('payment_method', ['cash', 'online']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->string('user_full_name')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_mobile')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
