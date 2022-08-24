<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAjaran::create([
            'tahun_awal' => '2022',
            'tahun_akhir' => '2023',
            'semester' => 'genap',
            'status' => 'aktif',
            'sekolah' => 'smk'
        ]);

        TahunAjaran::create([
            'tahun_awal' => '2022',
            'tahun_akhir' => '2023',
            'semester' => 'genap',
            'status' => 'aktif',
            'sekolah' => 'smp'
        ]);
    }
}
