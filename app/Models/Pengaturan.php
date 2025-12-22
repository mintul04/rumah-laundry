<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = [
        'logo',
        'nama_laundry',
        'email_laundry',
        'alamat_laundry',
        'nama_pemilik',
        'telepon_laundry',
    ];
}
