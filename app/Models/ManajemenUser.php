<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManajemenUser extends Model
{
    //
    protected $table = 'manajemen_users';
     protected $fillable = ['nama', 'username', 'email', 'password', 'level', 'jenis_kelamin', 'foto'];
}
