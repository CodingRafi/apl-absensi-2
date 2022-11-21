<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuIstirahat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function waktu_pelajaran(){
        return $this->belongsTo(WaktuPelajaran::class);
    }
}
