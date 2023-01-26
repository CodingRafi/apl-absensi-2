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

    public function agenda(){
        return $this->hasMany(Agenda::class);
    }

    public function absensi_pelajaran(){
        return $this->hasMany(AbsensiPelajaran::class);
    }

    public static function getTahunAjaran($request = null){
        $tahun_ajaran;
        if ($request) {
            if($request->tahun_awal && $request->tahun_akhir && $request->semester){
                $tahun_ajaran_query = TahunAjaran::where('tahun_awal', $request->tahun_awal)->where('tahun_akhir', $request->tahun_akhir)->where('semester', $request->semester)->first();
                
                if($tahun_ajaran_query){
                    $tahun_ajaran = $tahun_ajaran_query;
                }else{
                    $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
                }
            }else{
                $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
            }
        }else{
            $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
        }

        return $tahun_ajaran;
    }
    
    public static function redirectWithTahunAjaran($route, $request, $message){
        if($request->tahun_awal && $request->tahun_akhir && $request->semester){ 
            return redirect()->route($route, ['tahun_awal' => $request->tahun_awal, 'tahun_akhir' => $request->tahun_akhir, 'semester' => $request->semester])->with('msg_success', $message);
        }else{
            return redirect()->route($route)->with('msg_success', $message);
        }
    }

    public static function redirectWithTahunAjaranManual($route, $request, $message){
        if($request->tahun_awal && $request->tahun_akhir && $request->semester){ 
            return redirect($route . '?tahun_awal='. $request->tahun_awal . '&tahun_akhir=' . $request->tahun_akhir . '&semester='. $request->semester)->with('msg_success', $message);
        }else{
            return redirect($route)->with('msg_success', $message);
        }
    }
}
