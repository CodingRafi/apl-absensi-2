<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class);
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }
}
