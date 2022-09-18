<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class);
    }

    public static function get_agenda($kelas_id, $hari){
        return Agenda::where('kelas_id', $kelas_id)->where('hari', $hari)->orderBy('jam_awal', 'asc')->get();
    }
}
