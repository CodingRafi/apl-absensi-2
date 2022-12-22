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

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public static function createRfid($number_rfid, $user_id, $status){
        
    }

    public static function updateRfid($request){
        $rfid = Rfid::where('id', $request->id_rfid)->first();
        
        $rfid->update([
            'rfid_number' => $request->rfid_number,
            'status' => ($request->status_rfid   == 'on') ? 'aktif' : 'tidak'
        ]);
    }
}
