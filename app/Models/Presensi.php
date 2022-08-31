<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function absensi_pelajaran(){
        return $this->belongsTo(AbsensiPelajaran::class);
    }

    public function absensi(){
        return $this->belongsTo(Absensi::class);
    }
}
