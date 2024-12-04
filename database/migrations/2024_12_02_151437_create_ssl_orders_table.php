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
        Schema::create('ssl_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('amount');
            $table->string('address');
            $table->string('transaction_id');
            $table->string('currency');
            $table->string('delivery_charge');
            $table->string('city');
            $table->string('ship_check')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('ship_email')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('note')->nullable();
            $table->string('status');
            $table->string('shop_id');
            $table->string('shop_url');
            $table->string('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssl_orders');
    }
};
