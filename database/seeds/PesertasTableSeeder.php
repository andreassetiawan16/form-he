<?php

use Illuminate\Database\Seeder;

class PesertasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pesertas')->insert([
            'nama' => 'John Doe',
            'alamat' => 'Lorem Ipsum',
            'jenis_kelamin' => 'Laki-laki',
            'tinggi' => 165,
            'tempat_lahir' => 'Hawaii',
            'tanggal_lahir' => '2005-09-10 00:00:00',
            'usia' => 10
        ]);
    }
}
