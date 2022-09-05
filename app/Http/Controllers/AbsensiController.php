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
use Rap2hpoutre\FastExcel\FastExcel;

class AbsensiController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:view_absensi|add_absensi|edit_absensi|delete_absensi', ['only' => ['index','store']]);
        //  $this->middleware('permission:add_absensi', ['only' => ['create','store']]);
        //  $this->middleware('permission:edit_absensi', ['only' => ['edit','update']]);
        //  $this->middleware('permission:delete_absensi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {
        $now = Carbon::now();
        $month = request('idb') ?? $now->month;
        $year = $now->year;
        $date=[];
        
        for($d=0; $d<=32; $d++)
        {
            $time=mktime(24, 0, 0, $month, $d, $year);  
            if (date('m', $time)==$month)       
            $date[]=date('Y-m-d', $time);
            // $date[]=date('Y-m-d-D', $time);
        }

        $absensis = [];

        if($role == 'siswa'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if($tahun_ajaran){
                $kelas_filter = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
                $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
                $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();
                foreach ($siswas as $key => $siswa) {
                    $absensis[] = Absensi::get_absensi($siswa, $date, $role);
                }
            }else{
                $kelas_filter = [];
                $kompetensis = []; 
                $absensis = [];
                $siswas = [];   
            }

            return view('absensi', [
                'role' => $role,
                'date' => $date,
                'kompetensis' => $kompetensis,
                'kelas_filter' => $kelas_filter,
                'absensis' => $absensis,
                'siswas' => $siswas
            ]);
        }else{
            $users_query = User::filter(request(['search']))->where('sekolah_id', \Auth::user()->sekolah_id)->get();
            $users = [];
    
            foreach ($users_query as $key => $user) {
                if($user->hasRole($role)){
                    $users[] = $user;
                }
            }

            foreach ($users as $key => $user) {
                $absensis[] = Absensi::get_absensi($user, $date, $role);
            }

            return view('absensi', [
                'role' => $role,
                'date' => $date,
                'users' => $users,
                'absensis' => $absensis
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
    public function store(Request $request){
        if ($request->presensi == 'masuk') {
           
            if ($request->table == 'siswa') {
                $absensi = Absensi::where('siswa_id', $request->siswa_id)->where('kelas_id', $request->kelas_id)->whereDate('presensi_masuk', $request->date)->first();

                if(!$absensi){
                    if ($request->kehadiran == 'hadir') {
                        Absensi::create([
                            'rfid_id' => $request->rfid_id,
                            'siswa_id' => $request->siswa_id,
                            'kelas_id' => $request->kelas_id,
                            'kehadiran' => $request->kehadiran,
                            'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1] 
                        ]);
                    }else{
                        Absensi::create([
                            'rfid_id' => $request->rfid_id,
                            'siswa_id' => $request->siswa_id,
                            'kelas_id' => $request->kelas_id,
                            'kehadiran' => $request->kehadiran,
                            'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
                            'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1] 
                        ]);
                    }
                }

                return redirect()->back();
            }else{
                $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();
                if(!$absensi){
                    if ($request->kehadiran == 'hadir') {
                        Absensi::create([
                            'rfid_id' => $request->rfid_id,
                            'user_id' => $request->user_id,
                            'kehadiran' => $request->kehadiran,
                            'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1] 
                        ]);
                    }else{
                        Absensi::create([
                            'rfid_id' => $request->rfid_id,
                            'user_id' => $request->user_id,
                            'kehadiran' => $request->kehadiran,
                            'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
                            'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1] 
                        ]);
                    }
                }   

                return redirect()->back();
            }
        }else{
            if ($request->table == 'siswa') {
                $absensi = Absensi::where('siswa_id', $request->siswa_id)->where('kelas_id', $request->kelas_id)->whereDate('presensi_masuk', $request->date)->first();

                if($absensi){
                    if($request->kehadiran == $absensi->kehadiran){
                        $absensi->update([
                            'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                        ]);
                    }else{
                        return redirect()->back()->with('message', 'kehadiran tidak sesuai dengan presensi masuk');
                    }
                }else{
                    return redirect()->back()->with('message', 'belum presensi masuk');
                }
            }else{
                $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();

                if($absensi){
                    if($request->kehadiran == $absensi->kehadiran){
                        $absensi->update([
                            'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                        ]);
                    }else{
                        return redirect()->back()->with('message', 'kehadiran tidak sesuai dengan presensi masuk');
                    }
                }else{
                    return redirect()->back()->with('message', 'belum presensi masuk');
                }
            }
        }

        return redirect()->back();
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
        return view('users.detailabsensisiswa', [
            'absensi' => $absensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiRequest  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi, $id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($request->presensi == 'masuk') {
            if ($request->kehadiran == 'hadir') {
                $absensi->update([
                    'kehadiran' => $request->kehadiran,
                    'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
                    'presensi_pulang' => null
                ]);
            }else{
                $absensi->update([
                    'kehadiran' => $request->kehadiran,
                    'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
                    'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                ]);
            }

            return redirect()->back()->with('message', 'Berhasil Diupdate');
        }else{
            if($absensi->kehadiran == $request->kehadiran){
                $absensi->update([
                    'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                ]);

                return redirect()->back()->with('message', 'Berhasil Diupdate');
            }else{
                return redirect()->back()->with('message', 'tidak sama dengan absensi masuk');
            }
        }
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

    public function export(Request $request){
        $now = Carbon::now();
        $date=[];
        $month = request('idb') ?? $now->month;
        $year = $now->year;
        
        for($d=0; $d<=32; $d++)
        {
            $time=mktime(24, 0, 0, $month, $d, $year);  
            if (date('m', $time)==$month)       
            $date[]=date('Y-m-d', $time);
            // $date[]=date('Y-m-d-D', $time);
        }

        $absensis = [];
        
        if($request->role == 'siswa'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $kelas_filter = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

            $datas = [];
            foreach ($siswas as $key => $siswa) {
                $absensis[] = Absensi::get_absensi($siswa, $date);
            }

            foreach ($absensis as $key => $absensi) {
                $datas = [
                    'name' => $siswas[$key]->name,
                ];

                $finalArray = array_merge($datas, $absensi);
                dd($finalArray);
            }


            return (new FastExcel($finalArray))->download('absensi.xlsx');
        }else{
            $users_query = User::filter(request(['search']))->where('sekolah_id', \Auth::user()->sekolah_id)->get();
            $users = [];
    
            foreach ($users_query as $key => $user) {
                if($user->hasRole($role)){
                    $users[] = $user;
                }
            }

            foreach ($users as $key => $user) {
                $absensis[] = Absensi::get_absensi_siswa($user, $date);
            }

            return view('absensi', [
                'role' => $role,
                'date' => $date,
                'absensis' => $absensis
            ]);
        }
    }
}
