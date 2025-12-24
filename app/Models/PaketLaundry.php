<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketLaundry extends Model
{
    protected $table = 'paket_laundries';
    protected $fillable = ['nama_paket', 'harga', 'satuan', 'waktu_pengerjaan', 'deskripsi'];

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'paket_id', 'id');
    }
}
