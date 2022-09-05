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

    public static function get_presensi($siswa, $dates){
        $presensi_siswa = [];
        foreach ($dates as $key => $date) {
            $query = Presensi::where('siswa_id', $siswa->id)->whereDate('tgl_kehadiran', '=', $date)->first();

            if($query){
                $presensi_siswa[] = $query;
            }else{
                $presensi_siswa[] = [];
            }
        }

        return $presensi_siswa;
    }
}
