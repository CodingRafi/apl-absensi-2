<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Rfid;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function store(StoreAbsensiRequest $request){
        $rfid = Rfid::where('rfid_number', $request->rfid)->first();

        $absensi = Absensi::where('rfid_id', $rfid->id)->whereDate('presensi_masuk', Carbon::today())->first();

        if($absensi && $absensi->presensi_pulang === null){
            $user;
            
            $absensi->update([
                'presensi_pulang' => Carbon::now()
            ]);

            if($absensi->siswa){
                $user = $absensi->siswa;
            }else{  
                $user = $absensi->user;
            }

            return response()->json([
                'message' => 'Hati hati dijalan',
                'kode_respon' => '2',
                'user' => $user
            ], 200);
        }else{
            if(!$absensi){
                $now = Carbon::now();
                if ($rfid->siswa != '') {
                    Absensi::create([
                        'rfid_id' => $rfid->id,
                        'siswa_id' => $rfid->siswa->id,
                        'kelas_id' => $rfid->siswa->kelas->id,
                        'presensi_masuk' => $now
                    ]);

                    $agendas = Agenda::select('users.name as guru', 'mapels.nama as mapel', 'agendas.*', 'kelas.nama as nama_kelas')->leftJoin('kelas', 'kelas.id', 'agendas.kelas_id')->leftJoin('mapels', 'mapels.id', 'agendas.mapel_id')->leftJoin('users', 'users.id', 'agendas.user_id')->where('kelas_id', $rfid->siswa->kelas->id)->where('hari', strtolower($now->isoFormat('dddd')))->get();

                    return response()->json([
                        'message' => 'Berhasil absen masuk',
                        'agendas' => $agendas,
                        'hari' => strtolower($now->isoFormat('dddd')),
                        'kode_respon' => '1',
                        'siswa' => $rfid->siswa,
                        'kelas' => $rfid->siswa->kelas,
                        'kompetensi' => $rfid->siswa->kompetensi,
                    ], 200);
                }else{
                    Absensi::create([
                        'rfid_id' => $rfid->id,
                        'user_id' => $rfid->user->id,
                        'presensi_masuk' => $now
                    ]);
                    
                    if ($rfid->user->hasRole('guru')) {
                        $agendas = Agenda::select('kelas.nama as nama_kelas', 'mapels.nama as mapel', 'agendas.*', 'kelas.nama as nama_kelas')->leftJoin('kelas', 'kelas.id', 'agendas.kelas_id')->leftJoin('mapels', 'mapels.id', 'agendas.mapel_id')->leftJoin('users', 'users.id', 'agendas.user_id')->where('agendas.user_id', $rfid->user->id)->where('hari', strtolower($now->isoFormat('dddd')))->get();

                        return response()->json([
                            'message' => 'Berhasil absen masuk',
                            'agendas' => $agendas,
                            'hari' => strtolower($now->isoFormat('dddd')),
                            'kode_respon' => '1',
                            'user' => $rfid->user
                        ], 200);
                        return $rfid->user->mapel;
                    }else{
                        return response()->json([
                            'message' => 'Berhasil absen masuk',
                            'kode_respon' => '1',
                            'user' => $rfid->user
                        ], 200);
                    }

                }
            }else{
                return response()->json([
                    'message' => 'hari ini sudah absen masuk ataupun pulang',
                    'kode_respon' => '3'
                ], 200);
            }
        }

    }
}
