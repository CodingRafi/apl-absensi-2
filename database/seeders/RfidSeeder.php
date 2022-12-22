<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rfid;

class RfidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rfid::create([
            'rfid_number' => "0009251346",
            'user_id' => '5',
            'status' => 'aktif'
        ]); 
    }
}
