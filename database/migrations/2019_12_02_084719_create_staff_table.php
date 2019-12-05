<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nama');
            $table->string('posisi');
            $table->string('email');
            $table->string('usia');
            $table->longText('alamat');
            $table->string('jenis_kelamin');
            $table->integer('tinggi');
            $table->longText('tempat_lahir');
            $table->dateTime('tanggal_lahir');
            $table->string('no_telepon');
            $table->string('no_wa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
