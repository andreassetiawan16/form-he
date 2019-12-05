<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'nama', 'posisi','email', 'usia', 'alamat', 'jenis_kelamin', 'tinggi', 'tempat_lahir', 'tanggal_lahir', 'no_telepon', 'no_wa',
    ];
}
