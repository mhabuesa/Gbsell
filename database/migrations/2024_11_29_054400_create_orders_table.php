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
            $table->string('total')->nullable();
            $table->string('payment_method')->nullable();

            $table->string('name')->nullable(); // Name column
            $table->string('email')->nullable(); // Email column
            $table->string('phone')->nullable(); // Phone column
            $table->double('amount')->nullable(); // Amount column
            $table->text('address')->nullable(); // Address column
            $table->string('status')->nullable(); // Status column
            $table->string('transaction_id')->nullable(); // Transaction ID column
            $table->string('currency')->nullable(); // Currency column
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
