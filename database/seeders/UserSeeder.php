<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super_admin' => [
                'name_long' => 'Super Admin',
                'permission' => ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '58', '59', '60', '61', '62', '63', '64', '65']
            ],
            'yayasan' => [
                'name_long' => 'Yayasan',
                'permission' => ['1', '18', '22', '30', '36', '40', '44']
            ],
            'admin' => [
                'name_long' => 'Admin',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '22', '23', '24', '25', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '16', '49', '50', '51', '52', '53', '54', '55', '56', '66', '67', '68', '69']
            ],
            'guru' => [
                'name_long' => 'Guru',
                'permission' => ['48', '49', '53', '54', '55', '57', '41', '42', '43']
            ],
            'karyawan' => [
                'name_long' => 'Karyawan',
                'permission' => []
            ]
        ];

        foreach ($roles as $key => $role) {
            $role_insert = Role::create([
                'name' => $key,
                'guard_name' => 'web',
                'name_long' => $role['name_long']
            ]);
    
            $result = array_map(function($izin){
                return $izin;
            }, $role['permission']);
    
            $role_insert->syncPermissions($result);
        }

        // User Super Admin
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');

        // User Admin SMK TB
        $adminsmk = User::create([
            'name' => 'Admin SMK',
            'email' => 'adminsmk@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1
        ])->assignRole('admin');

        // User Yayasan SMK TB
        $yayasan = User::create([
            'name' => 'Yayasan',
            'email' => 'yayasan@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1
        ])->assignRole('yayasan');
    }
}
