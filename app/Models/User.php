<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function mapel(){
        return $this->belongsToMany(Mapel::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function rfid(){
        return $this->hasOne(Rfid::class);
    }

    public function absensi(){
        return $this->hasMany(absensi::class);
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }

    public function kelas(){
        return $this->belongsToMany(Kelas::class, 'user_kelas');
    }

    public function jeda_presensi(){
        return $this->belongsTo(JedaPresensi::class);
    }

    public function kelompok(){
        return $this->belongsToMany(Kelompok::class);
    }

    public function ref_agama(){
        return $this->belongsTo(ref_agama::class);
    }

    public function profile_user(){
        return $this->hasOne(profile_user::class);
    }

    public function profile_siswa(){
        return $this->hasOne(profile_siswa::class);
    }

    private static function parseDataToArray($datas){
        $return = [];

        foreach ($datas as $key => $data) {
            array_push($return, $data->id);
        }

        return $return;
    }

    public function scopeFilterUser($query, array $filter){
        $query->when($filter['search'] ?? false, function($query, $filter){
            return $query->where('profile_users.name', 'like', '%' . $filter . '%')
                        ->orWhere('users.email', 'like', '%' . $filter . '%')
                        ->orWhere('users.nip', 'like', '%' . $filter . '%');
        });
    }

    public function scopeFilterSiswa($query, array $filter){
        $query->when($filter['search'] ?? false, function($query, $filter){
            return $query->where('profile_siswas.name', 'like', '%' . $filter . '%');
        });

        $query->when($filter['kelas'] ?? false, function($query, $filter){
            return $query->where('kelas.id', $filter);
        });
        $query->when($filter['jurusan'] ?? false, function($query, $filter){
            return $query->where('kompetensis.id', $filter);
        });
    }

    public static function getUser($request, $role, $detail = false, $paginate = false){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        $users = User::when($role == 'siswa', function($q) use($role, $request, $tahun_ajaran, $detail){
                    $q->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                        ->when($detail, function($query) use ($detail){
                            $query->select('users.email', 'users.profil', 'users.nipd', 'profile_siswas.nisn', 'profile_siswas.nik','profile_siswas.jk', 'profile_siswas.jalan', 'profile_siswas.name', 'profile_siswas.tempat_lahir', 'profile_siswas.tanggal_lahir', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama', 'kelas.nama as kelas', 'kompetensis.kompetensi')
                            ->join('ref_agamas', 'profile_siswas.ref_agama_id', 'ref_agamas.id')
                            ->join('ref_provinsis', 'profile_siswas.ref_provinsi_id', 'ref_provinsis.id')
                            ->join('ref_kabupatens', 'profile_siswas.ref_kabupaten_id', 'ref_kabupatens.id')
                            ->join('ref_kecamatans', 'profile_siswas.ref_kecamatan_id', 'ref_kecamatans.id')
                            ->join('ref_kelurahans', 'profile_siswas.ref_kelurahan_id', 'ref_kelurahans.id');
                        })
                        ->when(!$detail, function($qu) use($detail){
                            $qu->select('users.*');
                        })
                        ->join('user_kelas', 'user_kelas.user_id', 'users.id')
                        ->join('kelas', 'user_kelas.kelas_id', 'kelas.id')
                        ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                        ->where('user_kelas.tahun_ajaran_id', $tahun_ajaran->id)
                        ->filterSiswa(request(['kelas', 'jurusan', 'search']));
                })
                ->when($role != 'siswa', function($q) use($role, $detail){
                    $q->when($detail, function($query) use ($detail){
                            $query->select('users.email', 'users.profil', 'users.nip','profile_users.jk', 'profile_users.tempat_lahir', 'profile_users.tanggal_lahir', 'profile_users.jalan', 'profile_users.name', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama')
                            ->join('ref_agamas', 'profile_users.ref_agama_id', 'ref_agamas.id')
                            ->join('ref_provinsis', 'profile_users.ref_provinsi_id', 'ref_provinsis.id')
                            ->join('ref_kabupatens', 'profile_users.ref_kabupaten_id', 'ref_kabupatens.id')
                            ->join('ref_kecamatans', 'profile_users.ref_kecamatan_id', 'ref_kecamatans.id')
                            ->join('ref_kelurahans', 'profile_users.ref_kelurahan_id', 'ref_kelurahans.id');
                        })
                        ->when(!$detail, function($qu) use($detail){
                            $qu->select('users.*');
                        })
                        ->join('profile_users', 'profile_users.user_id', 'users.id')
                        ->filterUser(request(['search']));
                })
                ->role($role) 
                ->where('users.sekolah_id', \Auth::user()->sekolah_id);

                if ($paginate) {
                    $users = $users->paginate(25)->withQueryString();
                } else {
                    $users = $users->get();
                }

        return $users;
    }

    public static function findUser($request, $role, $id){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $user = User::when($role == 'siswa', function ($q) use($role, $tahun_ajaran) {
                            return $q->select('users.id as user_id', 'users.email', 'users.profil', 'users.nipd', 'profile_siswas.nisn', 'profile_siswas.nik','profile_siswas.jk', 'profile_siswas.jalan', 'profile_siswas.name', 'profile_siswas.tempat_lahir', 'profile_siswas.tanggal_lahir', 'ref_provinsis.nama as provinsi', 'ref_provinsis.id as ref_provinsi_id', 'ref_kabupatens.nama as kabupaten', 'ref_kabupatens.id as ref_kabupaten_id', 'ref_kecamatans.nama as kecamatan', 'ref_kecamatans.id as ref_kecamatan_id', 'ref_kelurahans.nama as kelurahan', 'ref_kelurahans.id as ref_kelurahan_id', 'ref_agamas.nama as agama', 'ref_agamas.id as ref_agama_id', 'kelas.nama as kelas', 'kelas.id as kelas_id', 'kompetensis.kompetensi', 'kompetensis.id as kompetensi_id', 'ref_tingkats.romawi')
                                    ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                                    ->join('user_kelas', 'user_kelas.user_id', 'users.id')
                                    ->join('kelas', 'user_kelas.kelas_id', 'kelas.id')
                                    ->join('ref_tingkats', 'ref_tingkats.id', 'kelas.ref_tingkat_id')
                                    ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                                    ->join('ref_agamas', 'profile_siswas.ref_agama_id', 'ref_agamas.id')
                                    ->join('ref_provinsis', 'profile_siswas.ref_provinsi_id', 'ref_provinsis.id')
                                    ->join('ref_kabupatens', 'profile_siswas.ref_kabupaten_id', 'ref_kabupatens.id')
                                    ->join('ref_kecamatans', 'profile_siswas.ref_kecamatan_id', 'ref_kecamatans.id')
                                    ->join('ref_kelurahans', 'profile_siswas.ref_kelurahan_id', 'ref_kelurahans.id')
                                    ->where('user_kelas.tahun_ajaran_id', $tahun_ajaran->id);
                        })->when($role != 'siswa', function($q) use($role){
                            return $q->select('users.id as user_id', 'users.email', 'users.profil', 'users.nip', 'profile_users.*','profile_users.jk', 'profile_users.tempat_lahir', 'profile_users.tanggal_lahir', 'profile_users.jalan', 'profile_users.name', 'ref_provinsis.nama as provinsi', 'ref_provinsis.id as ref_provinsi_id', 'ref_kabupatens.nama as kabupaten', 'ref_kabupatens.id as ref_kabupaten_id', 'ref_kecamatans.nama as kecamatan', 'ref_kecamatans.id as ref_kecamatan_id', 'ref_kelurahans.nama as kelurahan', 'ref_kelurahans.id as ref_kelurahan_id', 'ref_agamas.nama as agama', 'ref_agamas.id as ref_agama_id')
                                    ->join('profile_users', 'profile_users.user_id', 'users.id')
                                    ->join('ref_agamas', 'profile_users.ref_agama_id', 'ref_agamas.id')
                                    ->join('ref_provinsis', 'profile_users.ref_provinsi_id', 'ref_provinsis.id')
                                    ->join('ref_kabupatens', 'profile_users.ref_kabupaten_id', 'ref_kabupatens.id')
                                    ->join('ref_kecamatans', 'profile_users.ref_kecamatan_id', 'ref_kecamatans.id')
                                    ->join('ref_kelurahans', 'profile_users.ref_kelurahan_id', 'ref_kelurahans.id');
                        })->where('users.id', $id)
                        ->role($role) 
                        ->where('users.sekolah_id', \Auth::user()->sekolah_id)
                        ->first();

        if ($role == 'guru') {
            $user['mapel'] = self::parseDataToArray(User::findOrFail($id)->mapel()->select('mapels.id')->get());
        }
        
        return $user;
    }

    public static function deleteUser($role, $id){
        $user = User::findOrFail($id);

        if ($user->hasRole('guru')) {
            foreach ($user->mapel as $key => $mapel) {
                $mapel->user()->detach($user->id);
            }
        }

        foreach ($user->agenda as $key => $agenda) {
            $agenda->update([
                'user_id' => null
            ]);
        }

        foreach ($user->absensi_pelajaran as $key => $absensi_pelajaran) {
            $absensi_pelajaran->update([
                'user_id' => null
            ]);
        }

        foreach ($user->kelompok as $key => $kelompok) {
            $kelompok->delete();
        }

        foreach ($user->absensi as $key => $absensi) {
            $absensi->delete();
        }

        if ($user->rfid) {
            $user->rfid->delete();
        }

        if ($role == 'siswa') {
            foreach ($user->kelas as $key => $kelas) {
                $kelas->users()->detach($user->id);
            }

            if ($user->profile_siswa) {
                $user->profile_siswa->delete();
            }
        } else {
            $user->profile_user->delete();
        }

        $user->delete();
    }
}
