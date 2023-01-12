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
}
