<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JedaPresensi;

class JedaPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JedaPresensi::create([
            'nama' => 'Presensi Guru',
            'jam_masuk' => '08:44:49',
            'jam_pulang' => '09:44:49',
            'role_id' => 3,
            'sekolah_id' => 1,
        ]);

        JedaPresensi::create([
            'nama' => 'Presensi Siswa',
            'jam_masuk' => '08:44:49',
            'jam_pulang' => '09:44:49',
            'siswa' => 1,
            'sekolah_id' => 1
        ]);
    }
}
