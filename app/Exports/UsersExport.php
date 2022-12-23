<?php

namespace App\Exports;

use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    protected $role;
    protected $request;

    public function __construct($role, $request){
        $this->role = $role;
        $this->request = $request;
    }

    public function view(): View
    {   
        $role = $this->role;
        $request = $this->request;

        $users = User::when($role == 'siswa', function($q) use($role, $request){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $q->select('users.email', 'users.profil', 'users.nipd', 'profile_siswas.nisn', 'profile_siswas.nik','profile_siswas.jk', 'profile_siswas.jalan', 'profile_siswas.name', 'profile_siswas.tempat_lahir', 'profile_siswas.tanggal_lahir', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama', 'kelas.nama as kelas', 'kompetensis.kompetensi')
                ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                ->join('kelas', 'profile_siswas.kelas_id', 'kelas.id')
                ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                ->join('tahun_ajarans', 'tahun_ajarans.id', 'profile_siswas.tahun_ajaran_id')
                ->join('ref_agamas', 'profile_siswas.ref_agama_id', 'ref_agamas.id')
                ->join('ref_provinsis', 'profile_siswas.ref_provinsi_id', 'ref_provinsis.id')
                ->join('ref_kabupatens', 'profile_siswas.ref_kabupaten_id', 'ref_kabupatens.id')
                ->join('ref_kecamatans', 'profile_siswas.ref_kecamatan_id', 'ref_kecamatans.id')
                ->join('ref_kelurahans', 'profile_siswas.ref_kelurahan_id', 'ref_kelurahans.id')
                ->where('profile_siswas.tahun_ajaran_id', $tahun_ajaran->id)
                ->filterSiswa(request(['kelas', 'jurusan', 'search']));
        })
        ->when($role != 'siswa', function($q) use($role){
            $q->select('users.email', 'users.profil', 'users.nip','profile_users.jk', 'profile_users.tempat_lahir', 'profile_users.tanggal_lahir', 'profile_users.jalan', 'profile_users.name', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama')
                ->join('profile_users', 'profile_users.user_id', 'users.id')
                ->join('ref_agamas', 'profile_users.ref_agama_id', 'ref_agamas.id')
                ->join('ref_provinsis', 'profile_users.ref_provinsi_id', 'ref_provinsis.id')
                ->join('ref_kabupatens', 'profile_users.ref_kabupaten_id', 'ref_kabupatens.id')
                ->join('ref_kecamatans', 'profile_users.ref_kecamatan_id', 'ref_kecamatans.id')
                ->join('ref_kelurahans', 'profile_users.ref_kelurahan_id', 'ref_kelurahans.id')
                ->filterUser(request(['search']));
        })
        ->role($role) 
        ->where('users.sekolah_id', \Auth::user()->sekolah_id)
        ->get();

        return view('users.export', [
            'users' => $users,
            'role' => $role
        ]);
    }
}
