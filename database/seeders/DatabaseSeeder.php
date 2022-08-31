<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Rfid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SekolahSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(KompetensiSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(RfidSeeder::class);
    }
}
