<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Rfid;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbsensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbsensiRequest $request)
    {
        $rfid = Rfid::where('rfid_number', $request->rfid)->first();

        $absensi = Absensi::where('rfid_id', $rfid->id)->whereDate('presensi_masuk', Carbon::today())->first();

        if($absensi && $absensi->presensi_pulang === null){
            $absensi->update([
                'presensi_pulang' => Carbon::now()
            ]);

            return response()->json([
                'message' => 'Hati hati dijalan'
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
                        'agendas' => $agendas
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
                            'agendas' => $rfid->user->agenda
                        ], 200);
                        return $rfid->user->mapel;
                    }else{
                        return response()->json([
                            'message' => 'Berhasil absen masuk'
                        ], 200);
                    }

                }
            }else{
                return response()->json([
                    'message' => 'hari ini sudah absen masuk ataupun pulang'
                ], 200);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiRequest  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
