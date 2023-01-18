<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPelajaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function waktu_istirahat(){
        return $this->hasOne(WaktuIstirahat::class);
    }
    
    public static function get_wapel_is_null(){
        return \DB::table('waktu_pelajarans as a')->select('a.*')
        ->leftJoin('waktu_istirahats as b', function($join){
            $join->on('a.id', '=', 'b.waktu_pelajaran_id')
                ->where('a.sekolah_id', \Auth::user()->sekolah_id);
        })->whereNull('b.waktu_pelajaran_id')->get();
    }

    public static function get_wapel(){
        $jams = [];
        for ($i=1; $i < config('services.jml_jam_mapel'); $i++) { 
           $jams[] = WaktuPelajaran::where('jam_ke', $i)->where('sekolah_id', \Auth::user()->sekolah_id)->first();
        }
        return collect($jams);
    }
}
