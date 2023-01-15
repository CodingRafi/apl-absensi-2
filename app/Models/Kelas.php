<?php

namespace App\Models;

use DB, Auth    ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function tahun_ajaran(){
    //     return $this->belongsTo(TahunAjaran::class);
    // }

    public function users(){
        return $this->belongsToMany(User::class, 'user_kelas');
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function absensi(){
        return $this->hasMany(Absensi::class );
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }

    public function tingkat(){
        return $this->belongsTo(ref_tingkat::class, 'ref_tingkat_id');
    }

    public static function getKelas($request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        return DB::table('kelas')
                    ->select('kelas.*', 'ref_tingkats.romawi')
                    ->join('ref_tingkats', 'ref_tingkats.id', 'kelas.ref_tingkat_id')
                    ->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                    ->get();
    }
}
