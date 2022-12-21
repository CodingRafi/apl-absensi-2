<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ref_kecamatan;

class RefKecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = json_decode(file_get_contents(__DIR__.'/../../public/ref_wilayah/kecamatan.json'));

        foreach ($datas as $key => $data) {
            ref_kecamatan::create([
                'id' => $data->id,
                'nama' => $data->nama,
            ]);
        }
    }
}
