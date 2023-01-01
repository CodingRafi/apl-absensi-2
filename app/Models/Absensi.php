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

    public static function get_absensi($user, $dates, $role, $tahun_ajaran){
        $user = User::where('users.id', $user->id)
                    ->when($role == 'siswa', function($q) use($role) {
                        $q->select('users.id', 'profile_siswas.name')
                            ->join('profile_siswas', 'profile_siswas.user_id', 'users.id');
                    })->when($role != 'siswa', function($q) use($role){
                        $q->select('users.id', 'profile_users.name')
                            ->join('profile_users', 'profile_users.user_id', 'users.id');
                    }) 
                    ->first();
        $data = [
            'user' => $user,
            'absensis' => []
        ];

        foreach ($dates as $key => $date) {
            \DB::enableQueryLog();
            $query = Absensi::where('user_id', $user->id)->where('tahun_ajaran_id', $tahun_ajaran->id)->whereDate('presensi_masuk', '=', $date)->first();
            $query ? $data['absensis'][] = $query : $data['absensis'][] = [];
        }
        return $data;
    }
}
