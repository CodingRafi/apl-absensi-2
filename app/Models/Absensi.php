<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rfid(){
        return $this->belongsTo(Rfid::class);
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function presensi(){
        return $this->hasOne(Presensi::class);
    }

    public static function get_absensi($user, $dates){
        $absensi_siswa = [];
        foreach ($dates as $key => $date) {
            $query = Absensi::where('user_id', $user->id)->orWhere('siswa_id', $user->id)->whereDate('presensi_masuk', '=', $date)->first();

            if($query){
                $absensi_siswa[] = $query;
            }else{
                $absensi_siswa[] = [];
            }
        }

        return $absensi_siswa;
    }
}
