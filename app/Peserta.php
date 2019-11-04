<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'jenis_kelamin', 'tinggi', 'tempat_lahir', 'tanggal_lahir', 'usia'
    ];
}
