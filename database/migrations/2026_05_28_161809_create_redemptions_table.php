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
    Schema::create('redemptions', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel users (siapa yang nuker)
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        // Relasi ke tabel rewards (barang apa yang dituker)
        $table->foreignId('reward_id')->constrained()->cascadeOnDelete();
        
        $table->integer('points_spent'); // Poin yang kepotong
        $table->string('status')->default('pending'); // Status penukaran
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
