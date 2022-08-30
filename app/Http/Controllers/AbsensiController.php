<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {
        if($role == 'siswa'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $kelas_filter = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

            return view('absensi', [
                'users' => $siswas,
                'role' => $role
            ]);
        }else{
            $users_query = User::filter(request(['search']))->where('sekolah_id', \Auth::user()->sekolah_id)->get();
            $users = [];
    
            foreach ($users_query as $key => $user) {
                if($user->hasRole($role)){
                    $users[] = $user;
                }
            }

            return view('absensi', [
                'users' => $users,
                'role' => $role
            ]);
        }
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
