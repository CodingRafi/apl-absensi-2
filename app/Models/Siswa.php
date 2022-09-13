<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Siswa as Authenticatable;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class Siswa extends Authenticatable
{
    use HasFactory,HasRoles;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function kompetensi(){
        return $this->belongsTo(Kompetensi::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function rfid(){
        return $this->hasOne(Rfid::class);
    }

    public function absensi(){
        return $this->hasMany(Absensi::class);
    }

    public function presensi(){
        return $this->hasMany(Presensi::class);
    }

    public function scopeFilter($query, array $filter){
        $query->when($filter['idk'] ?? false, function($query, $filter){
            return $query->where('kelas.id', $filter);
        });
        $query->when($filter['idj'] ?? false, function($query, $filter){
            return $query->where('kompetensis.id', $filter);
        });

        $query->when($filter['search'] ?? false, function($query, $filter){
            return $query->where('siswas.name', 'like', '%' . $filter . '%')
                        ->orWhere('siswas.nisn', 'like', '%' . $filter . '%')
                        ->orWhere('siswas.nipd', 'like', '%' . $filter . '%')
                        ->orWhere('siswas.nik', 'like', '%' . $filter . '%');
        });
    }

    public function jeda_presensi(){
        return $this->belongsTo(JedaPresensi::class);
    }

    public static function filterDate($date){
        $explode_date;
        if (gettype($date) == 'string') {
            $explode_date = explode(' ', $date);

            if(count($explode_date) < 3){
                $explode_date_with = explode('-', $date);
                if(count($explode_date_with) < 3){
                    return null;
                }
                return Carbon::parse($date)->isoFormat('YYYY-MM-DD');
            }

            $month;
            
            if(preg_match("/". strtolower($explode_date[1]) ."/i", 'januari')){
                $month = 1;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'februari')) {
                $month = 2;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'maret')) {
                $month = 3;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'april')) {
                $month = 4;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'mei')) {
                $month = 5;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'juni')) {
                $month = 6;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'juli')) {
                $month = 7;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'agustus')) {
                $month = 8;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'september')) {
                $month = 9;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'oktober')) {
               $month = 10;
            }elseif (preg_match("/". strtolower($explode_date[1]) ."/i", 'november')) {
                $month = 11;
            }else {
                $month = 12;
            }
            return $explode_date[2] . '-' . $month . '-' . $explode_date[0];
        }else{
            return $date;
        }

    }

    public static function deleteSiswa($id){
        $siswa = Siswa::findOrFail($id);
        if ($siswa->sekolah_id == \Auth::user()->sekolah->id) {
            if ($siswa->rfid) {
                $siswa->rfid->delete();
            }
            foreach ($siswa->absensi as $key => $absensi) {
                $absensi->delete();
            }
            $siswa->delete();
        }else{
            abort(403);
        }
    }
}
