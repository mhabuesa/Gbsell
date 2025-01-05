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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('type');
            $table->string('city');
            $table->string('address');
            $table->string('url');
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default(0);
            $table->date('expiry_date')->nullable();
            $table->string('visitors')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
