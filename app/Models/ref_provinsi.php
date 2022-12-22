<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_provinsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ref_kabupaten(){
        return $this->hasMany(ref_kabupaten::class);
    }
}
