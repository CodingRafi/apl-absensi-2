<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_kelurahan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ref_kecamatan(){
        return $this->belongsTo(ref_kecamatan::class);
    }
}
