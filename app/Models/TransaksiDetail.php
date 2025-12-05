<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $fillable = [
        'transaksi_id',
        'paket_id',
        'berat',
        'subtotal',
    ];

    // Relasi ke model Transaksi (Many-to-One)
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Relasi ke model PaketLaundry (Many-to-One)
    public function paket()
    {
        return $this->belongsTo(PaketLaundry::class, 'paket_id');
    }
}
