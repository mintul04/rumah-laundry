<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    // di Model Pesanan
    protected $fillable = [
        'kode_pesanan',
        'nama_layanan',
        'nama_paket',
        'harga',
        'created_by'
    ];
}
