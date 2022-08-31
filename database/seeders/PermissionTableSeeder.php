<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',
            'import_users',
            'export_users',

            'view_roles',
            'add_roles',
            'edit_roles',

            'view_tahun_ajaran',
            'add_tahun_ajaran',
            'edit_tahun_ajaran',
            'delete_tahun_ajaran',

            'view_sekolah',
            'add_sekolah',
            'edit_sekolah',
            'delete_sekolah',

            'view_kelas',
            'add_kelas',
            'edit_kelas',
            'delete_kelas',

            'view_kompetensi',
            'add_kompetensi',
            'edit_kompetensi',
            'delete_kompetensi',

            'view_rfid',
            'add_rfid',
            'edit_rfid',
            'delete_rfid',

            'view_siswa',
            'add_siswa',
            'edit_siswa',
            'delete_siswa',
            'import_siswa',
            'export_siswa',

            'view_mapel',
            'add_mapel',
            'edit_mapel',
            'delete_mapel',

            'view_agenda',
            'add_agenda',
            'edit_agenda',
            'delete_agenda',

            'view_absensi',
            'add_absensi',
            'edit_absensi',
            'delete_absensi',
            
            'show_agenda_guru'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
