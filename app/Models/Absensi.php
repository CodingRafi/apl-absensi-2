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
        $data = [
            'user' => ($role == 'siswa' ? $user->profile_siswa->select('profile_siswas.name')->first() : $user->profile_user->select('profile_users.name')->first()),
            'absensis' => []
        ];
        foreach ($dates as $key => $date) {
            \DB::enableQueryLog();
            $query = Absensi::where('user_id', $user->id)->whereDate('presensi_masuk', '=', $date)->first();
            $query ? $data['absensis'][] = $query : $data['absensis'][] = [];
        }
        return $data;
    }
}
