<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function absensi(){
        return $this->hasMany(Absensi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
