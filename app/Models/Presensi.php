<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function absensi_pelajaran(){
        return $this->belongsTo(AbsensiPelajaran::class);
    }

    public function absensi(){
        return $this->belongsTo(Absensi::class);
    }

    public static function get_absensi($user, $dates, $tahun_ajaran){
        $user = User::where('users.id', $user->id)
                    ->select('users.id', 'profile_siswas.name')
                    ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                    ->role('siswa')
                    ->first();

        $data = [
            'user' => $user,
            'absensis' => []
        ];

        foreach ($dates as $key => $date) {
            \DB::enableQueryLog();
            $query = Presensi::select('presensis.*')
                                ->join('absensi_pelajarans', 'absensi_pelajarans.id', 'presensis.absensi_pelajaran_id')
                                ->where('presensis.user_id', $user->id)
                                ->where('absensi_pelajarans.tahun_ajaran_id', $tahun_ajaran->id)
                                ->whereDate('presensis.presensi_masuk', '=', $date)
                                ->first();
            $query ? $data['absensis'][] = $query : $data['absensis'][] = [];
        }

        return $data;
    }
}
