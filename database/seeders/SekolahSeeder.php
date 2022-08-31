<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sekolah;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sekolah::create([
            'nama' => 'SMK Taruna Bhakti',
            'npsn' => '20229232',
            'alamat' => 'Gang Nangka',
            'tingkat' => 'smk'
        ]);

        Sekolah::create([
            'nama' => 'SMP Taruna Bhakti',
            'npsn' => '20229122',
            'alamat' => 'Gang Nangka',
            'tingkat' => 'smp'
        ]);
    }
}
