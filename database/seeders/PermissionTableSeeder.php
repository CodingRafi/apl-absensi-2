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
            'export_absensi',
            
            'show_agenda_user',

            'view_absensi_pelajaran',
            'add_absensi_pelajaran',
            'edit_absensi_pelajaran',
            'delete_absensi_pelajaran',
            
            'view_presensi',
            'add_presensi',
            'edit_presensi',
            'delete_presensi',

            'show_absensi',

            'view_status_kehadiran',
            'add_status_kehadiran',
            'edit_status_kehadiran',
            'delete_status_kehadiran',

            'view_agama',
            'add_agama',
            'edit_agama',
            'delete_agama',

            'view_waktu_pelajaran',
            'add_waktu_pelajaran',
            'edit_waktu_pelajaran',
            'delete_waktu_pelajaran',

            'view_kelompok',
            'add_kelompok',
            'edit_kelompok',
            'delete_kelompok',

            'export_absensi_pelajaran',
            'upgrade_kelas',

            'add_kelompok_jadwal',
            'edit_kelompok_jadwal',
            'delete_kelompok_jadwal',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
