<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan');
            $table->string('no_order')->unique();
            $table->date('tanggal_terima');
            $table->datetime('tanggal_selesai')->nullable();
            $table->enum('pembayaran', ['lunas', 'belum_lunas', 'dp'])->default('belum_lunas');
            $table->decimal('jumlah_dp', 15, 2)->nullable();
            $table->enum('status_order', ['baru', 'diproses', 'selesai', 'diambil', 'kadaluarsa'])->default('baru');
            $table->datetime('jatuh_tempo_at')->nullable();
            $table->datetime('diambil_at')->nullable();
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
