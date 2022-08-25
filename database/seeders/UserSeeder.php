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
        //? Role Yayasan 
        $role = Role::create([
            'name' => 'yayasan',
            'guard_name' => 'web'
        ]);

        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);

        $yayasanSmk = User::create([
            'name' => 'yayasan SMK',
            'email' => 'yayasansmk@gmail.com',
            'password' => bcrypt('12345678'),
            'sekolah_id' => 1
        ]);

        $yayasanSmk->assignRole('yayasan');

        $yayasanSmp = User::create([
            'name' => 'yayasan SMP',
            'email' => 'yayasansmp@gmail.com',
            'password' => bcrypt('12345678'),
            'sekolah_id' => 2
        ]);

        $yayasanSmp->assignRole('yayasan');

        //? Membuat role admin 
        $roleAdminSmk = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $izinAdminSmk = ['1', '9', '10', '11', '12', '13', '14', '15', '16'];
        $resultAdminSmk = array_map(function($izinAdmin){
            return $izinAdmin;
        }, $izinAdminSmk);

        $roleAdminSmk->syncPermissions($resultAdminSmk);

        $adminSmk = User::create([
            'name' => 'Admin SMK',
            'email' => 'adminsmk@gmail.com',
            'password' => bcrypt('12345678'),
            'sekolah_id' => 1
        ]);

        $adminSmk->assignRole('admin');

        $adminSmp = User::create([
            'name' => 'Admin SMP',
            'email' => 'adminsmp@gmail.com',
            'password' => bcrypt('12345678'),
            'sekolah_id' => 2
        ]);

        $adminSmp->assignRole('admin');

        
        //? guru piket
        $rolePiket = Role::create([
            'name' => 'guru_piket',
            'guard_name' => 'web'
        ]);

        $izinGuruPiket = ['1', '9', '10', '11', '12', '13', '14', '15', '16'];
        $resultGuruPiket = array_map(function($izinPiket){
            return $izinPiket;
        }, $izinGuruPiket);
        $rolePiket->syncPermissions($resultGuruPiket);

        //? role guru
        $roleGuru = Role::create([
            'name' => 'guru',
            'guard_name' => 'web'
        ]);

        $izinGuru = ['1', '9', '10', '11', '12', '13', '14', '15', '16'];
        $resultGuru = array_map(function($izin){
            return $izin;
        }, $izinGuru);
        $roleGuru->syncPermissions($resultGuru);

        //? role super admin
        $roleSuperAdmin = Role::create([
            'name' => 'super_admin',
            'guard_name' => 'web'
        ]);

        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $superAdmin->assignRole('super_admin');

        //? Role Karyawan
        $roleKaryawan = Role::create([
            'name' => 'karyawan',
            'guard_name' => 'web'
        ]);

        $izinKaryaran = ['1', '9', '10', '11', '12', '13', '14', '15', '16'];
        $resultKaryawan = array_map(function($izin){
            return $izin;
        }, $izinKaryaran);
        $roleKaryawan->syncPermissions($resultKaryawan);

        //? Membuat Role Student 
        // $roleStudent = Role::create([
        //     'name' => 'student',
        //     'guard_name' => 'web'
        // ]);

        // $izinStudents = ['9', '13'];

        // $resultStudent = array_map(function($izinStudent){
        //     return $izinStudent;
        // },$izinStudents);

        // $roleStudent->syncPermissions($resultStudent);

        // $user = User::create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);

        // $user->assignRole('student');
    }
}
