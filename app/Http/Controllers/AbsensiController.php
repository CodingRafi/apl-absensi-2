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
         $this->middleware('permission:view_absensi|add_absensi|edit_absensi|delete_absensi', ['only' => ['index','store']]);
         $this->middleware('permission:add_absensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_absensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_absensi', ['only' => ['destroy']]);
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
            $kelas_filter = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

            foreach ($siswas as $key => $siswa) {
                $absensis[] = Absensi::get_absensi($siswa, $date);
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
                $absensis[] = Absensi::get_absensi($user, $date);
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
    public function store(StoreAbsensiRequest $request)
    {
        // 
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
