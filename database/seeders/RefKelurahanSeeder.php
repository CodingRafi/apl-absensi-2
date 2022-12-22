<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ref_kelurahan;

class RefKelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = json_decode(file_get_contents(__DIR__.'/../../public/ref_wilayah/kelurahan.json'));

        foreach ($datas as $key => $data) {
            ref_kelurahan::create([
                'id' => $data->id,
                'nama' => $data->nama,
            ]);
        }
    }
}
