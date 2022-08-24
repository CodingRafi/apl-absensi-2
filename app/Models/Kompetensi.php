<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa() {
        return $this->hasMany(Siswa::class);
    }
}
