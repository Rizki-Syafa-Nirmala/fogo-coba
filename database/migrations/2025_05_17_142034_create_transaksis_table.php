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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('makanan_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->integer('total_harga');
            $table->boolean('point')->default(0);
            $table->string('order_id')->unique();
            $table->enum('status', ['Proses', 'Siap ambil', 'Selesai'])->default('Proses');
            $table->enum('status_pembayaran', ['belum dibayar','dibatalkan', 'sudah dibayar', 'gagal', 'proses'])->default('belum dibayar');
            $table->string('snap_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
