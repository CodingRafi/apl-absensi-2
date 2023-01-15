<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function kompetensi(){
        return $this->hasMany(Kompetensi::class);
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }

    public function mapel(){
        return $this->hasMany(Mapel::class);
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }

    public function jeda_presensi(){
        return $this->hasMany(JedaPresensi::class);
    }

    public function tingkat(){
        return $this->belongsToMany(ref_tingkat::class, 'sekolah_tingkat');
    }
}

