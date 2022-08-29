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

    public static function createRfid($number_rfid, $siswa_id, $user_id, $status){
        if ($siswa_id != null) {
            Rfid::create([
                'rfid_number' => $number_rfid,
                'siswa_id' => $siswa_id,
                'status' => ($status == 'on') ? 'aktif' : 'tidak'
            ]);
        }else if($user_id != null){
            Rfid::create([
                'rfid_number' => $number_rfid,
                'user_id' => $user_id,
                'status' => ($status == 'on') ? 'aktif' : 'tidak'
            ]);
        }
    }

    public static function updateRfid($request){
        $rfid = Rfid::where('id', $request->id_rfid)->first();
        
        $rfid->update([
            'rfid_number' => $request->rfid,
            'status' => ($request->status_rfid   == 'on') ? 'aktif' : 'tidak'
        ]);
    }
}
