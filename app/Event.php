<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
    'pembicara', 'tanggal_event', 'topik', 'jumlah_peserta'
    ];
}
