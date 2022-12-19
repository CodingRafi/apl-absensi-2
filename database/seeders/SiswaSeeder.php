<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'name' => 'oke',
            'nisn' => '2345',
            'nipd' => '234567',
            'jk' => 'L',
            'email' => 'asd@gmail.com',
            'kelas_id' => 1,
            'kompetensi_id' => 1,
            'tempat_lahir' => 'asd',
            'nik' => '123',
            'ref_agama_id' => 1,
            'jalan' => '24',
            'kelurahan' => 'ase',
            'kecamatan' => 'asda',
            'kota_kab' => 'asda',
            'provinsi' => 'asda',
            'sekolah_id' => 1,
        ]);
    }
}
