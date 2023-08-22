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
        Schema::table('payment_info', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_page_id'); // Идентификатор платежной страницы
            $table->foreign('payment_page_id')->references('id')->on('payment_pages'); // Связь с таблицей payment_pages

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('payment_info', function (Blueprint $table) {
                $table->dropColumn('payment_page_id');
            });
        }
};
