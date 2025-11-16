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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_layanan');
            $table->foreignId('id_pelanggan');
            $table->string('kode_pesanan');
            $table->string('tipe');
            $table->string('berat');
            $table->text('catatan');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['pending', 'jemput', 'proses', 'packing', 'antar', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
