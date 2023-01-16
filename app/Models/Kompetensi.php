<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function profile_siswa(){
        return $this->hasMany(profile_siswa::class);
    }

    public function sekolah(){
        return $this->belonsTo(Sekolah::class);
    }
}
