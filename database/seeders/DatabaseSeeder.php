<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sekolah;
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

        
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TahunAjaranSeeder::class);

        Rfid::create([
            'rfid_number' => "0009251346",
            'user_id' => '5',
            'status' => 'aktif'
        ]); 
    }
}
