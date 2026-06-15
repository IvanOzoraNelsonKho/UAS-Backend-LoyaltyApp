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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('merchant_id')->constrained()->onDelete('cascade'); // ngehubungkin ke merchant
        $table->string('order_id')->unique(); // bikin 12 karakter random huruf & angka (buat Nota)
        $table->string('recipient_name');
        $table->string('recipient_phone');
        $table->string('payment_method'); // bisa milih pakai qris, cash, transfer_bank
        $table->string('bank_name')->nullable(); // kalau transfer bank misa milih pake apa BNI, BCA, Mandiri, Seabank
        $table->string('order_type'); // dine_in, take_away
        $table->integer('total_price');
        $table->string('status')->default('Pesanan sedang diproses'); // Dikontrol Admin
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
