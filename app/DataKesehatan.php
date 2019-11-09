<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{

  protected $fillable = [
    'peserta_id', 'tempat_tanggal_he', 'bab_setiap_hari', 'bab_malam_hari', 'tensi_sistol', 'tensi_diastol', 'asam_urat', 'gula_darah', 'kolestrol','hasil_lingkar_perut', 'nilai_rujukan_lingkar_perut', 'status_berat_badan', 'hasil_berat_badan', 'nilai_rujukan_berat_badan', 'angka_lemak_tubuh', 'perbandingan_standar_lemak_tubuh', 'indeks_masa_tubuh','angka_lemak_lapisan_organ', 'perbandingan_standar_lemak_lapisan_organ', 'hasil_resting_metabolism', 'nilai_rujukan_resting_metabolism', 'hasil_usia_tubuh', 'nilai_rujukan_usia_tubuh', 'keluhan','catatan_dokter'
  ];

  public function peserta()
  {
    return $this->belongsTo(Peserta::class);
  }

}
