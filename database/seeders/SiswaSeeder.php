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
            'kelas_id' => 1,
            'kompetensi_id' => 1,
            'tempat_lahir' => 'asd',
            'nik' => '123',
            'agama' => 'islam',
            'jalan' => '24',
            'kelurahan' => 'ase',
            'kecamatan' => 'asda',
            'sekolah_id' => 1,
            'jeda_presensi_id' => 2
        ]);
    }
}
