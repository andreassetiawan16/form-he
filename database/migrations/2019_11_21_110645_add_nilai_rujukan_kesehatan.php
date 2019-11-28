<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNilaiRujukanKesehatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kesehatans', function (Blueprint $table) {
            $table->string('nilai_rujukan_bab_setiap_hari')->nullable();
            $table->string('nilai_rujukan_bak_malam_hari')->nullable();
            $table->string('nilai_rujukan_tensi_sistol')->nullable();
            $table->string('nilai_rujukan_tensi_diastol')->nullable();
            $table->double('nilai_rujukan_asam_urat_l')->nullable();
            $table->double('nilai_rujukan_asam_urat_p')->nullable();
            $table->string('nilai_rujukan_gula_darah_gdp')->nullable();
            $table->string('nilai_rujukan_gula_darah_gds')->nullable();
            $table->string('nilai_rujukan_kolestrol')->nullable();
            $table->string('nilai_rujukan_lemak_tubuh_l')->nullable();
            $table->string('nilai_rujukan_lemak_tubuh_p')->nullable();
            $table->string('nilai_rujukan_indeks_masa_tubuh')->nullable();
            $table->string('nilai_rujukan_lemak_lapisan_organ')->nullable();
            $table->boolean('intensif_program')->default(false);
            $table->string('otot_seluruh_tubuh')->nullable();
            $table->string('otot_lengan')->nullable();
            $table->string('otot_trunk')->nullable();
            $table->string('otot_kaki')->nullable();
            $table->string('lemak_seluruh_tubuh')->nullable();
            $table->string('lemak_lengan')->nullable();
            $table->string('lemak_trunk')->nullable();
            $table->string('lemak_kaki')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
