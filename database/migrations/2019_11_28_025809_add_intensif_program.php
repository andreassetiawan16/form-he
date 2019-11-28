<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIntensifProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kesehatans', function (Blueprint $table) {
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
