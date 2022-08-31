<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiPelajaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function presensi(){
        return $this->hasMany(Presensi::class);
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }
}
