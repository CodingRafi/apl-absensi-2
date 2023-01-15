<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_tingkat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sekolah(){
        return $this->belongsToMany(Sekolah::class, 'sekolah_tingkat');
    }

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }
}
