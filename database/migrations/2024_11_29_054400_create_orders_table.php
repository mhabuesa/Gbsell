<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('charge')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('discount')->nullable();
            $table->string('total')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('dalivery_status')->nullable(); // Dalivery Status column
            $table->string('dalivery_method')->nullable(); // Dalivery Method column
            $table->string('status')->nullable(); // Status column
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
