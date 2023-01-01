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
            'tingkat' => 'smk',
            'ref_provinsi_id' => 11,
            'ref_kabupaten_id' => 1102,
            'ref_kecamatan_id' => 110203,
            'ref_kelurahan_id' => 1102032001,
            'jalan' => 'asd'
        ]);

        // Sekolah::create([
        //     'nama' => 'SMP Taruna Bhakti',
        //     'npsn' => '20229122',
        //     'alamat' => 'Gang Nangka',
        //     'tingkat' => 'smp'
        // ]);
    }
}
