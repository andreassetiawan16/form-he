<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{

  protected $fillable = [
    'peserta_id', 'tempat_he', 'tanggal_he', 'bab_setiap_hari', 'bab_malam_hari', 'tensi_sistol', 'tensi_diastol', 'asam_urat', 'gula_darah', 'kolestrol','hasil_lingkar_perut', 'nilai_rujukan_lingkar_perut', 'hasil_berat_badan', 'nilai_rujukan_berat_badan', 'angka_lemak_tubuh', 'perbandingan_standar_lemak_tubuh', 'indeks_masa_tubuh','angka_lemak_lapisan_organ', 'perbandingan_standar_lemak_lapisan_organ', 'hasil_resting_metabolism', 'nilai_rujukan_resting_metabolism', 'hasil_usia_tubuh', 'nilai_rujukan_usia_tubuh', 'keluhan','catatan_dokter', 'nilai_rujukan_bab_setiap_hari', 'nilai_rujukan_bak_malam_hari', 'nilai_rujukan_tensi_sistol', 'nilai_rujukan_tensi_diastol', 'nilai_rujukan_asam_urat_l', 'nilai_rujukan_asam_urat_p', 'nilai_rujukan_gula_darah_gdp', 'nilai_rujukan_gula_darah_gds', 'nilai_rujukan_kolestrol', 'nilai_rujukan_lemak_tubuh_l', 'nilai_rujukan_lemak_tubuh_p', 'nilai_rujukan_indeks_masa_tubuh', 'nilai_rujukan_lemak_lapisan_organ', 'nilai_rujukan_usia_tubuh', 'intensif_program', 'otot_seluruh_tubuh', 'otot_lengan', 'otot_trunk', 'otot_kaki', 'lemak_seluruh_tubuh', 'lemak_lengan', 'lemak_trunk', 'lemak_kaki'
  ];

  public function peserta()
  {
    return $this->belongsTo(Peserta::class);
  }

}
