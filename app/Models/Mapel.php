<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongToMany(User::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }
}
