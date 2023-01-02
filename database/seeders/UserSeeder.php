<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\profile_user;
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
                'permission' => ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '53', '54', '55', '56', '57', '58', '59', '60']
            ],
            'yayasan' => [
                'name_long' => 'Yayasan',
                'permission' => ['1', '18', '22', '30', '36']
            ],
            'admin' => [
                'name_long' => 'Admin',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '22', '23', '24', '25', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '61', '62', '63', '64', '65', '66', '67', '68']
            ],
            'guru' => [
                'name_long' => 'Guru',
                'permission' => ['43','44', '45', '46', '47', '48', '49', '52']
            ],
            'karyawan' => [
                'name_long' => 'Karyawan',
                'permission' => ['43','52']
            ],
            'siswa' => [
                'name_long' => 'Siswa',
                'permission' => ['43','52']
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
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');

        profile_user::create([
            'name' => 'Super Admin',
            'user_id' => $super_admin->id
        ]);

        // User Admin SMK TB
        $adminsmk = User::create([
            'email' => 'adminsmk@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1
        ])->assignRole('admin');

        profile_user::create([
            'name' => 'Admin SMK',
            'user_id' => $adminsmk->id
        ]);

        // User Yayasan SMK TB
        $yayasan = User::create([
            'email' => 'yayasan@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1
        ])->assignRole('yayasan');

        profile_user::create([
            'name' => 'Yayasan SMK',
            'user_id' => $yayasan->id
        ]);
    }
}
