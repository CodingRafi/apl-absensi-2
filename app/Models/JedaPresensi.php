<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JedaPresensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function role(){
        return $this->belongsTo(\Spatie\Permission\Models\Role::class);
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
