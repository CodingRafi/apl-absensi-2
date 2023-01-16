<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_agama extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function profile_siswa(){
        return $this->hasMany(profile_siswa::class);
    }

    public function profile_user(){
        return $this->hasMany(profile_user::class);
    }
}
