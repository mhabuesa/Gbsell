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
        Schema::create('cart_variant_products', function (Blueprint $table) {
            $table->id();
            $table->string('shop_id');
            $table->string('order_id');
            $table->string('product_id');
            $table->string('attribute_id');
            $table->string('color_id');
            $table->string('quantity');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_variant_products');
    }
};
