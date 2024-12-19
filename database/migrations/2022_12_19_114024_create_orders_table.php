<?php

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
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('payment_way',['app','on_receipt']);
            $table->enum('receiving',['print_center','delivery']);
            $table->foreignIdFor(UserAddress::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(QsDateOrder::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(OrderStatus::class)->constrained()->cascadeOnDelete();
            $table->double('cost')->default(0);
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
