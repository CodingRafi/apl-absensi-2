<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas(){
        return $this->hasMany(Kelas::class);
    }

    public static function getTahunAjaran($request){
        $tahun_ajaran;
        if($request->tahun_awal && $request->tahun_akhir && $request->semester){
            $tahun_ajaran_query = TahunAjaran::where('tahun_awal', $request->tahun_awal)->where('tahun_akhir', $request->tahun_akhit)->where('semester', $request->semester)->first();
            
            if($tahun_ajaran_query){
                $tahun_ajaran = $tahun_ajaran_query;
            }else{
                $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
            }
        }else{
            $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
        }

        return $tahun_ajaran;
    }
}
