<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kompetensi;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kompetensi::create([
            'kompetensi' => 'Rekayasa Perangkat Lunak',
            'bidang' => 'oke',
            'program' => 'oke',
            'sekolah_id' => 1
        ]);
    }
}
