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
        Schema::create('transaction_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
        $table->foreignId('reward_id')->constrained()->onDelete('cascade'); // ngehubungin ke ID Menu dari katalog
        $table->integer('quantity')->default(1);
        $table->string('size'); // pilih reguler, large
        $table->string('ice_level'); // pilih normal, less
        $table->string('sugar_level'); // pilih normal, less
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
