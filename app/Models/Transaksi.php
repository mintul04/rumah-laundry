<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Table name (opsional kalau sesuai)
    protected $table = 'transaksis';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'id_pelanggan',
        'no_order',
        'tanggal_terima',
        'tanggal_selesai',
        'jumlah_dp',
        'pembayaran',
        'status_order',
        'total',
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    // Generate nomor order otomatis (misal: ORD-0001)
    public static function generateNoOrder()
    {
        // Implementasikan logika generate no_order Anda di sini
        // Contoh sederhana:
        $prefix = 'ORD-';
        $latest = self::latest('id')->first();
        $nextNumber = $latest ? (int) substr($latest->no_order, strlen($prefix)) + 1 : 1;
        return $prefix . sprintf('%06d', $nextNumber);
    }
}
