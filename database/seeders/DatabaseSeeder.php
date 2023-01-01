<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RefProvinsiSeeder::class);
        $this->call(SekolahSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(RefAgamaSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(KompetensiSeeder::class);
        // $this->call(SiswaSeeder::class);
        // $this->call(RfidSeeder::class);
        $this->call(StatusKehadiranSeeder::class);
    }
}
