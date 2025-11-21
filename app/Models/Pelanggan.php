<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'tanggal_lahir',
        'pekerjaan',
        'telepon',
        'alamat',
        'jenis_kelamin',
    ];
}
