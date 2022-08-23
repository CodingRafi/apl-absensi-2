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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);


        //? Membuat role Teacher 
        $roleTeacher = Role::create([
            'name' => 'teacher',
            'guard_name' => 'web'
        ]);

        $izinTeachers = ['1', '9', '10', '11', '12', '13', '14', '15', '16'];
        $resultTeacher = array_map(function($izinTeacher){
            return $izinTeacher;
        }, $izinTeachers);

        $roleTeacher->syncPermissions($resultTeacher);


        //? Membuat Role Student 
        $roleStudent = Role::create([
            'name' => 'student',
            'guard_name' => 'web'
        ]);

        $izinStudents = ['9', '13'];

        $resultStudent = array_map(function($izinStudent){
            return $izinStudent;
        },$izinStudents);

        $roleStudent->syncPermissions($resultStudent);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('student');
    }
}
