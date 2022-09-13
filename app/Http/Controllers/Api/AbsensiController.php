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
        $now = Carbon::now();

        if ($rfid) {
            $absensi = Absensi::where('rfid_id', $rfid->id)->whereDate('presensi_masuk', Carbon::today())->first();
    
            if ($rfid->status == 'aktif') {
                if($absensi && $absensi->presensi_pulang === null){
                    $user;
                    
                    if($absensi->siswa){
                        if ($absensi->siswa->jeda_waktu) {
                            $user = $absensi->siswa;
                            $timeUser = $absensi->siswa->jeda_presensi->jam_pulang;
    
                            if (date('H', $date) >= explode(':', $timeUser)[0] && date('i', $date) >= explode(':', $timeUser)[1]) {
                                $absensi->update([
                                    'presensi_pulang' => Carbon::now()
                                ]);
                            }else{
                                return response()->json([
                                    'message' => 'Belom Pulang',
                                    'kode_respon' => '5'
                                ], 200);
                            }
                        } else {
                            return response()->json([
                                'message' => 'anda tidak memiliki jeda waktu, silahkan lapor guru piket',
                                'kode_respon' => '6',
                            ], 200);
                        }
                    }else{  
                        if ($absensi->user->jeda_waktu) {
                            $user = $absensi->user;
                            $timeUser = $absensi->user->jeda_presensi->jam_pulang;
    
                            if (date('H', $date) >= explode(':', $timeUser)[0] && date('i', $date) >= explode(':', $timeUser)[1]) {
                                $absensi->update([
                                    'presensi_pulang' => Carbon::now()
                                ]);
                            }else{
                                return response()->json([
                                    'message' => 'Belom Pulang',
                                    'kode_respon' => '5'
                                ], 200);
                            }
                        } else {
                            return response()->json([
                                'message' => 'anda tidak memiliki jeda waktu, silahkan lapor guru piket',
                                'kode_respon' => '6',
                            ], 200);
                        }
                        
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
                            if ($rfid->siswa->jeda_presensi) {
                                $date = strtotime($now);
                                $timeUser = $rfid->siswa->jeda_presensi->jam_masuk;
    
                                if (date('H', $date) <= explode(':', $timeUser)[0] && date('i', $date) <= explode(':', $timeUser)[1]) {
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
                                } else {
                                    return response()->json([
                                        'message' => 'Maaf anda sudah terlambat. Silahkan lapor ke guru piket',
                                        'kode_respon' => '4'
                                    ], 200);
                                }
                            } else {
                                return response()->json([
                                    'message' => 'anda tidak memiliki jeda waktu, silahkan lapor guru piket',
                                    'kode_respon' => '6',
                                ], 200);
                            }
                        }else{
                            if ($rfid->user->jeda_presensi) {
                                $date = strtotime($now);
                                $timeUser = $rfid->user->jeda_presensi->jam_masuk;
    
                                if (date('H', $date) <= explode(':', $timeUser)[0] && date('i', $date) <= explode(':', $timeUser)[1]) {
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
                                }else{
                                    return response()->json([
                                        'message' => 'Maaf anda sudah terlambat. Silahkan lapor ke guru piket',
                                        'kode_respon' => '4'
                                    ], 200);
                                }
                            } else {
                                return response()->json([
                                    'message' => 'anda tidak memiliki jeda waktu, silahkan lapor guru piket',
                                    'kode_respon' => '6',
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
            }else{
                return response()->json([
                    'message' => 'Rfid sudah tidak aktif',
                    'kode_respon' => 4
                ], 200);
            }
        }


    }
}
