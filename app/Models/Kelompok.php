<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function kelompok_jadwal(){
        return $this->hasMany(KelompokJadwal::class);
    }
}
