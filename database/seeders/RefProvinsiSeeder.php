<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RefProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsis = json_decode(file_get_contents('https://ibnux.github.io/data-indonesia/provinsi.json'));

        foreach ($provinsis as $key => $provinsi) {
            DB::table('ref_provinsis')->insert([
                'id' => $provinsi->id,
                'nama' => $provinsi->nama,
            ]);
            $kabupatens = json_decode(file_get_contents('https://ibnux.github.io/data-indonesia/kabupaten/'. $provinsi->id .'.json'));
            foreach ($kabupatens as $key => $kabupaten) {
                DB::table('ref_kabupatens')->insert([
                    'id' => $kabupaten->id,
                    'nama' => $kabupaten->nama,
                    'ref_provinsi_id' => $provinsi->id
                ]);
                $kecamatans = json_decode(file_get_contents('https://ibnux.github.io/data-indonesia/kecamatan/'. $kabupaten->id .'.json'));
                foreach ($kecamatans as $key => $kecamatan) {
                    DB::table('ref_kecamatans')->insert([
                        'id' => $kecamatan->id,
                        'nama' => $kecamatan->nama,
                        'ref_kabupaten_id' => $kabupaten->id
                    ]);
                    $kelurahans = json_decode(file_get_contents('https://ibnux.github.io/data-indonesia/kelurahan/'. $kecamatan->id .'.json'));
                    foreach ($kelurahans as $key => $kelurahan) {
                        DB::table('ref_kelurahans')->insert([
                            'id' => $kelurahan->id,
                            'nama' => $kelurahan->nama,
                            'ref_kecamatan_id' => $kecamatan->id
                        ]);
                    }
                }
            }
        }
    }
}
