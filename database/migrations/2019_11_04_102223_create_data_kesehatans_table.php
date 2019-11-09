<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKesehatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kesehatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('peserta_id');
            $table->longText('tempat_tanggal_he');
            $table->integer('bab_setiap_hari');
            $table->integer('bab_malam_hari');
            $table->integer('tensi_sistol');
            $table->integer('tensi_diastol');
            $table->integer('asam_urat');
            $table->integer('gula_darah');
            $table->integer('kolestrol');
            $table->integer('hasil_lingkar_perut');
            $table->integer('nilai_rujukan_lingkar_perut');
            $table->string('status_berat_badan');
            $table->integer('hasil_berat_badan');
            $table->integer('nilai_rujukan_berat_badan');
            $table->integer('angka_lemak_tubuh');
            $table->string('perbandingan_standar_lemak_tubuh');
            $table->integer('indeks_masa_tubuh');
            $table->integer('angka_lemak_lapisan_organ');
            $table->string('perbandingan_standar_lemak_lapisan_organ');
            $table->string('hasil_resting_metabolism');
            $table->string('nilai_rujukan_resting_metabolism');
            $table->integer('hasil_usia_tubuh');
            $table->integer('nilai_rujukan_usia_tubuh');
            $table->longText('keluhan');
            $table->longText('catatan_dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_kesehatans');
    }
}
