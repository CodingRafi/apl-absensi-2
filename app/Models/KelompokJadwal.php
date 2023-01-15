<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokJadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelompok(){
        return $this->belongsTo(Kelompok::class);
    }
}
