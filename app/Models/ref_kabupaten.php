<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_kabupaten extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ref_provinsi(){
        return $this->belongsTo(ref_provinsi::class);
    }
    
    public function ref_kecamatan(){
        return $this->hasMany(ref_kecamatan::class);
    }
}
