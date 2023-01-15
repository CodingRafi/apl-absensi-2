<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RefTingkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('services.tingkat') as $key => $row) {
            DB::table('ref_tingkats')->insert([
                'key' => $key,
                'romawi' => $row
            ]);
        }
    }
}
