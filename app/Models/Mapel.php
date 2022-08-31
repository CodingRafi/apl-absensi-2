<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }
}
