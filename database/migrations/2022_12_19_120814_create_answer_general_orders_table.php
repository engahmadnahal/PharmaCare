<?php

use App\Models\Order;
use App\Models\QsGeneralOrder;
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
        Schema::create('answer_general_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(QsGeneralOrder::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete();
            $table->string("answer");
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
        Schema::dropIfExists('answer_general_orders');
    }
};
