<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'nama', 'email', 'usia', 'alamat', 'jenis_kelamin', 'tinggi', 'tempat_lahir', 'tanggal_lahir', 'no_telepon', 'no_wa',
    ];
    
    public function dataKesehatan()
    {
        return $this->hasMany(DataKesehatan::class);
    }

}
