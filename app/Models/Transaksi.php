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
        'no_order',
        'nama_pelanggan',
        'tanggal_terima',
        'tanggal_selesai',
        'pembayaran',
        'status_order',
        'total',
    ];

    // Generate nomor order otomatis (misal: ORD-0001)
    public static function generateNoOrder()
    {
        // Ambil no_order terakhir
        $last = self::orderBy('id', 'DESC')->first();

        if (!$last) {
            return 'ORD-0001';
        }

        // Ambil angka dari no_order sebelumnya
        $number = (int) substr($last->no_order, 4);

        // Naikkan +1
        $number++;

        // Format ulang
        return 'ORD-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
