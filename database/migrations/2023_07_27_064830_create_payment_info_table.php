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
        Schema::create('payment_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('public_id', 100);
            $table->string('order_num', 100);
            $table->string('order_status', 20);
            $table->string('card', 20);
            $table->string('date', 25);
            $table->string('card_name',255);
            $table->string('customer_email', 255);
            $table->string('customer_ip', 255);
            $table->string('phone', 255);
            $table->string('fin', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('order_amount', 20);
            $table->string('subject', 255);
            $table->string('description', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_info');
    }
};
