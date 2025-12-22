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
            $table->string('no_order')->unique();
            $table->string('nama_pelanggan');
            $table->date('tanggal_terima');
            $table->date('tanggal_selesai');
            $table->enum('pembayaran', ['lunas', 'belum_lunas', 'dp'])->default('belum_lunas');
            $table->decimal('jumlah_dp', 15, 2)->nullable();
            $table->enum('status_order', ['baru', 'diproses', 'selesai', 'diambil'])->default('baru');
            $table->integer('total')->default(0);
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
