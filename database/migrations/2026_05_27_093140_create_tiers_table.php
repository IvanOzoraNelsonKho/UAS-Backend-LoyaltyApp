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
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('min_points')->default(0);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('tier_id')->references('id')->on('tiers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Putuskan hubungan foreign key terlebih dahulu sebelum menghapus tabel
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropForeign(['tier_id']);
        // });

        Schema::dropIfExists('tiers');
    }
};
