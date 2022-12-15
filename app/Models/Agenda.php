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

    public function waktu_pelajaran(){
        return $this->belongsTo(WaktuPelajaran::class);
    }

    public static function get_agenda($id, $role){
        $agendas = [];

        foreach (config('services.hari.value') as $key => $hari) {
            $agendas[$hari] = Agenda::select('agendas.*', 'waktu_pelajarans.jam_ke')
                                ->join('waktu_pelajarans', 'waktu_pelajarans.id', 'agendas.waktu_pelajaran_id')
                                ->when($role == 'siswa', function ($query) use($role, $id) {
                                    $query->where('agendas.kelas_id', $id);
                                })
                                ->when($role != 'siswa', function ($query) use($role, $id) {
                                    $query->where('agendas.user_id', $id);
                                })
                                ->orderBy('waktu_pelajarans.jam_ke')
                                ->where('hari', $hari)
                                ->get();
        }

        return $agendas;
    }
}
