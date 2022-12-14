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
        // admin 1 = SD
        // admin 2 = SMP
        // admin 3 = SMA
        // admin 4 = SMK

        $roles = [
            'super_admin' => [
                'name_long' => 'Super Admin',
                'permission' => ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17']
            ],
            'yayasan' => [
                'name_long' => 'Yayasan',
                'permission' => ['1', '18', '22', '30', '36', '40', '44']
            ],
            'admin_4' => [
                'name_long' => 'Admin SMK',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '22', '23', '24', '25', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '16', '49', '50', '51', '52', '53', '54', '55', '56', '58', '59', '60', '61']
            ],
            'admin_3' => [
                'name_long' => 'Admin SMA',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '22', '23', '24', '25', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '16', '49', '50', '51', '52', '53', '54', '55', '56', '58', '59', '60', '61']
            ],
            'admin_2' => [
                'name_long' => 'Admin SMP',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '16', '49', '50', '51', '52', '53', '54', '55', '56', '58', '59', '60', '61']
            ],
            'admin_1' => [
                'name_long' => 'Admin SD',
                'permission' => ['1', '2', '3', '4', '5', '6', '18', '19', '20', '21', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '16', '49', '50', '51', '52', '53', '54', '55', '56', '58', '59', '60', '61']
            ],
            'guru' => [
                'name_long' => 'Guru',
                'permission' => ['48', '49', '53', '54', '55', '57', '41', '42', '43']
            ],
            'karyawan' => [
                'name_long' => 'Karyawan',
                'permission' => []
            ],
            'siswa' => [
                'name_long' => 'Siswa',
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
    }
}
