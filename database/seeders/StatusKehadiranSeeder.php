<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusKehadiran;

class StatusKehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusKehadiran::create([
            'nama' => 'Masuk',
            'color' => '#57B657'
        ]);
    }
}
