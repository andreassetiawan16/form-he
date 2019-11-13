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
            $table->longText('tempat_he')->nullable();
            $table->dateTime('tanggal_he');
            $table->integer('bab_setiap_hari')->nullable();
            $table->integer('bab_malam_hari')->nullable();
            $table->integer('tensi_sistol')->nullable();
            $table->integer('tensi_diastol')->nullable();
            $table->integer('asam_urat')->nullable();
            $table->integer('gula_darah')->nullable();
            $table->integer('kolestrol')->nullable();
            $table->integer('hasil_lingkar_perut')->nullable();
            $table->integer('nilai_rujukan_lingkar_perut')->nullable();
            $table->string('status_berat_badan')->nullable();
            $table->integer('hasil_berat_badan')->nullable();
            $table->integer('nilai_rujukan_berat_badan')->nullable();
            $table->integer('angka_lemak_tubuh')->nullable();
            $table->string('perbandingan_standar_lemak_tubuh')->nullable();
            $table->integer('indeks_masa_tubuh')->nullable();
            $table->integer('angka_lemak_lapisan_organ')->nullable();
            $table->string('perbandingan_standar_lemak_lapisan_organ')->nullable();
            $table->string('hasil_resting_metabolism')->nullable();
            $table->string('nilai_rujukan_resting_metabolism')->nullable();
            $table->integer('hasil_usia_tubuh')->nullable();
            $table->integer('nilai_rujukan_usia_tubuh')->nullable();
            $table->longText('keluhan')->nullable();
            $table->longText('catatan_dokter')->nullable();
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
