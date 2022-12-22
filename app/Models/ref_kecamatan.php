<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_kecamatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ref_kabupaten(){
        return $this->belongsTo(ref_kabupaten::class);
    }

    public function ref_kelurahan(){
        return $this->hasMany(ref_kelurahan::class);
    }
}
