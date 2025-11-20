<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketLaundry extends Model
{
    protected $table = 'paket_laundries';
    protected $fillable = ['nama_paket', 'harga', 'waktu_pengerjaan', 'deskripsi'];
}
