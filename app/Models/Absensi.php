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

    public static function get_absensi($user, $dates, $role){
        $absensis = [];
        foreach ($dates as $key => $date) {
            \DB::enableQueryLog();
            if ($role == 'siswa') {
                $query = Absensi::where('siswa_id', $user->id)->whereDate('presensi_masuk', '=', $date)->first();
            } else {
                $query = Absensi::where('user_id', $user->id)->whereDate('presensi_masuk', '=', $date)->first();
            }

            if($query){
                $absensis[] = $query;
            }else{
                $absensis[] = [];
            }
        }

        // dd($absensis);
        return $absensis;
    }
}
