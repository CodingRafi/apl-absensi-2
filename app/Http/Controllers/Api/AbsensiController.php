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

        if (strtolower($now->isoFormat('dddd')) != 'minggu') {
            if ($rfid) {
                if ($rfid->status == 'aktif') {
                    $role = $rfid->user->getRoleNames()[0];
                    $agendas = $this->agenda('asc', $role, $rfid, $now);
                    if (count($agendas) > 0) {
                        $hour = strtotime($now);
                        $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
                        $absensi = Absensi::select('absensis.*')
                                    ->join('users', 'users.id', 'absensis.user_id')
                                    ->join('rfids', 'rfids.user_id', 'users.id')
                                    ->where('rfids.id', $rfid->id)
                                    ->whereDate('presensi_masuk', Carbon::today())
                                    ->first();
                        
                        if($absensi && $absensi->presensi_pulang === null){
                            $agendas = $this->agenda('desc', $role, $rfid, $now);
                            $timeUser = $agendas[0]->jam_akhir;
                            if (date('H', $hour) > explode(':', $timeUser)[0]) {
                                $absensi->update([
                                    'presensi_pulang' => Carbon::now()
                                ]);
                                return response()->json([
                                    'message' => 'Hati hati dijalan',
                                    'kode_respon' => '2',
                                    'user' => ($role == 'siswa' ? $rfid->user->profile_siswa : $rfid->user->profile_user)
                                ], 200);
                            }else if(date('i', $hour) >= explode(':', $timeUser)[1] && date('H', $hour) == explode(':', $timeUser)[0]){
                                $absensi->update([
                                    'presensi_pulang' => Carbon::now()
                                ]);
                                return response()->json([
                                    'message' => 'Hati hati dijalan',
                                    'kode_respon' => '2',
                                    'user' => ($role == 'siswa' ? $rfid->user->profile_siswa : $rfid->user->profile_user)
                                ], 200);
                            }else{
                                return response()->json([
                                    'message' => 'Belom Pulang',
                                    'kode_respon' => '5'
                                ], 200);
                            }
                        }else{
                            if(!$absensi){
                                $now = Carbon::now();  
                                $timeUser = $agendas[0]->waktu_pelajaran->jam_awal;
                                
                                if (date('H', $hour) < explode(':', $timeUser)[0]) {
                                    $absensi12 = Absensi::create([
                                        'user_id' => $rfid->user->id,
                                        'presensi_masuk' => $now,
                                        'tahun_ajaran_id' => $tahun_ajaran->id,
                                        'status_kehadiran_id' => 1
                                    ]);
                                    
                                    return response()->json([
                                        'message' => 'Berhasil absen masuk',
                                        'agendas' => $agendas,
                                        'hari' => strtolower($now->isoFormat('dddd')),
                                        'kode_respon' => '1',
                                        'user' => ($role == 'siswa' ? $rfid->user->profile_siswa : $rfid->user->profile_user)
                                    ], 200);
                                }else if(date('i', $hour) <= explode(':', $timeUser)[1] && date('H', $hour) == explode(':', $timeUser)[0]){
                                    Absensi::create([
                                        'user_id' => $rfid->user->id,
                                        'presensi_masuk' => $now,
                                        'tahun_ajaran_id' => $tahun_ajaran->id,
                                        'status_kehadiran_id' => 1
                                    ]);
                
                                    return response()->json([
                                        'message' => 'Berhasil absen masuk',
                                        'agendas' => $agendas,
                                        'hari' => strtolower($now->isoFormat('dddd')),
                                        'kode_respon' => '1',
                                        'user' => ($role == 'siswa' ? $rfid->user->profile_siswa : $rfid->user->profile_user)
                                    ], 200);
                                }else {
                                    return response()->json([
                                        'message' => 'Maaf anda sudah terlambat. Silahkan lapor ke guru piket',
                                        'kode_respon' => '4'
                                    ], 200);
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
                            'message' => 'anda tidak memiliki agenda',
                            'kode_respon' => '6',
                        ], 200);
                    }
                }else{
                    return response()->json([
                        'message' => 'Rfid tidak aktif',
                        'kode_respon' => '7'
                    ], 200);
                }
            }else{
                return response()->json([
                    'message' => 'Rfid tidak ditemukan',
                    'kode_respon' => '8'
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'Sekarang hari minggu',
                'kode_respon' => 9
            ], 200);
        }
    }

    private function agenda($orderBy = 'asc', $role, $rfid, $now){
        return Agenda::select('agendas.*')
                ->when($role == 'siswa', function($q) use($role, $rfid){
                    $q->join('users', 'agendas.user_id', 'users.id')
                    ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                    ->join('kelas', 'kelas.id', 'profile_siswas.kelas_id')
                    ->where('kelas.id', $rfid->profile_siswa->kelas->id);
                })
                ->when($role != 'siswa', function($q) {
                    $q->join('users', 'agendas.user_id', 'users.id');
                })
                ->join('waktu_pelajarans', 'waktu_pelajarans.id', 'agendas.waktu_pelajaran_id')
                ->where('hari', strtolower($now->isoFormat('dddd')))
                ->orderBy('waktu_pelajarans.jam_ke', $orderBy)
                ->get();
    }
}
