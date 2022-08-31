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
            $absensi->update([
                'presensi_pulang' => Carbon::now()
            ]);

            return response()->json([
                'message' => 'Hati hati dijalan',
                'kode_respon' => '2'
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

                    $agendas = Agenda::where('kelas_id', $rfid->siswa->kelas->id)->where('hari', strtolower($now->isoFormat('dddd')))->get();

                    return response()->json([
                        'message' => 'Berhasil absen masuk',
                        'agendas' => $agendas,
                        'kode_respon' => '1'
                    ], 200);
                }else{
                    Absensi::create([
                        'rfid_id' => $rfid->id,
                        'user_id' => $rfid->user->id,
                        'presensi_masuk' => $now
                    ]);
                    
                    if ($rfid->user->hasRole('guru')) {
                        return response()->json([
                            'message' => 'Berhasil absen masuk',
                            'agendas' => $rfid->user->agenda,
                            'kode_respon' => '1'
                        ], 200);
                        return $rfid->user->mapel;
                    }else{
                        return response()->json([
                            'message' => 'Berhasil absen masuk',
                            'kode_respon' => '1'
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
