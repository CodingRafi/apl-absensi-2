<?php

namespace App\Http\Controllers;

use Auth, DB;
use App\Models\Absensi;
use App\Models\StatusKehadiran;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Rfid;
use App\Exports\AbsensiExport;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_absensi|add_absensi|edit_absensi|delete_absensi', ['only' => ['index','store']]);
         $this->middleware('permission:add_absensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_absensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_absensi', ['only' => ['destroy']]);
         $this->middleware('permission:export_absensi', ['only' => ['export']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {
        //! date 
        $now = Carbon::now();
        $month = $now->year . '-' . (int) (request('bulan') ?? $now->month);
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $date = [];
        while ($start->lte($end)) {
            $date[] = Carbon::parse($start->copy())->format('Y-m-d');
            $start->addDay();
        }

        //! Absensi 
        $absensis = [];
        $status_kehadiran = StatusKehadiran::all();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        
        $users = User::select('users.*')
            ->when($role == 'siswa', function($q) use($role, $request){
                $q->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                ->join('kelas', 'profile_siswas.kelas_id', 'kelas.id')
                ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                ->join('tahun_ajarans', 'tahun_ajarans.id', 'profile_siswas.tahun_ajaran_id')
                ->where('profile_siswas.tahun_ajaran_id', $tahun_ajaran->id)
                ->filterSiswa(request(['kelas', 'jurusan', 'search']));
            })
            ->when($role != 'siswa', function($q) use($role){
                $q->join('profile_users', 'profile_users.user_id', 'users.id')
                ->filterUser(request(['search']));
            })
            ->role($role) 
            ->where('users.sekolah_id', \Auth::user()->sekolah_id)
            ->get();
            
        $return = [
            'role' => $role,
            'date' => $date,
            'users' => $users,
            'status_kehadiran' => $status_kehadiran,
        ];
        
        if ($role == 'siswa') {
            if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma') {
                $return += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $return += ['kelas' => DB::table('kelas')->where('sekolah_id', Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get()];
        }

        foreach ($users as $key => $user) {
            $absensis[] = Absensi::get_absensi($user, $date, $role);
        }

        $return += ['absensis' => $absensis];

        return view('absensi', $return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    public function store_update(Request $request){
        if ($request->presensi == 'masuk') {
            $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();
            if(!$absensi){
                $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
                Absensi::create([
                    'user_id' => $request->user_id,
                    'status_kehadiran_id' => $request->status_kahadiran_id,
                    'presensi_masuk' => (($request->waktu) ? ($request->date . ' ' . $request->waktu .  ':00') : ($request->date . ' ' . explode(' ', Carbon::now())[1])),
                    'tahun_ajaran_id' => $tahun_ajaran->id
                ]);
            }else{
                $update = ['status_kehadiran_id' => $request->status_kahadiran_id];
                
                if ($request->presensi == 'masuk') {
                    $update += ['presensi_masuk' => $request->date . ' ' . $request->waktu];
                } else {
                    $update += ['presensi_pulang' => $request->date . ' ' . $request->waktu];
                }

                $absensi->update($update);
            }
        }else{
            $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();
            if($absensi){
                if($request->kehadiran == $absensi->kehadiran){
                    $absensi->update([
                        'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                    ]);
                }else{
                    return redirect()->back()->with('msg_error', 'Kehadiran tidak sesuai dengan presensi masuk');
                }
            }else{
                return redirect()->back()->with('msg_error', 'Belum presensi masuk');
            }
        }

        return redirect()->back()->with('msg_success', 'Berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $absensi = Absensi::findOrFail($id);
        return response()->json([
            'data' => $absensi
        ], 200);
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
        abort(404);
        // $absensi = Absensi::findOrFail($id);

        // if ($request->presensi == 'masuk') {
        //     if ($request->kehadiran == 'hadir') {
        //         $absensi->update([
        //             'kehadiran' => $request->kehadiran,
        //             'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
        //             'presensi_pulang' => null
        //         ]);
        //     }else{
        //         $absensi->update([
        //             'kehadiran' => $request->kehadiran,
        //             'presensi_masuk' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1],
        //             'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
        //         ]);
        //     }

        //     return redirect()->back()->with('msg_succes', 'Berhasil Diupdate');
        // }else{
        //     if($absensi->kehadiran == $request->kehadiran){
        //         $absensi->update([
        //             'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . $request->waktu .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
        //         ]);

        //         return redirect()->back()->with('msg_succes', 'Berhasil Diupdate');
        //     }else{
        //         return redirect()->back()->with('msg_succes', 'tidak sama dengan absensi masuk');
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        abort(404);
    }

    public function export(Request $request){
        $role = request('role');
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
                $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();
                foreach ($siswas as $key => $siswa) {
                    $absensis[] = Absensi::get_absensi($siswa, $date, $role);
                }
            }else{
                $absensis = [];
                $siswas = [];
            }
            
            return Excel::download(new AbsensiExport($role, $absensis, $siswas, null, $date), 'absensi.xlsx');
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

            return Excel::download(new AbsensiExport($role, $absensis, null, $users, $date), 'absensi.xlsx');
        }
    }

    public function showAbsensi(Request $request){
        if (\Auth::user()->can('show_absensi') || \Auth::user()->getTable() == 'siswas') {
            $now = Carbon::now();
            $month = request('idb') ?? $now->month;
            $year = $now->year;
            $date=[];
            $role;
            
            for($d=0; $d<=32; $d++)
            {
                $time=mktime(24, 0, 0, $month, $d, $year);  
                if (date('m', $time)==$month)       
                $date[]=date('Y-m-d', $time);
                // $date[]=date('Y-m-d-D', $time);
            }

            $absensis = [];
            
            if( \Auth::user()->getTable() == 'siswas' ){
                $role = 'siswa';
                $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
                if($tahun_ajaran){
                    $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->where('siswas.id', \Auth::user()->id)->get();
                    foreach ($siswas as $key => $siswa) {
                        $absensis[] = Absensi::get_absensi($siswa, $date, $role);
                    }
                }else{
                    $absensis = [];
                    
                    $siswas = [];
                }
                
                return view('show_absensi', [
                    'role' => $role,
                    'date' => $date,
                    'absensis' => $absensis,
                    'siswas' => $siswas
                ]);
            }else{
                $role = 'users';
                $users = User::where('sekolah_id', \Auth::user()->sekolah_id)->where('id', \Auth::user()->id)->get();

                foreach ($users as $key => $user) {
                    $absensis[] = Absensi::get_absensi($user, $date, $role);
                }

                return view('show_absensi', [
                    'role' => $role,
                    'date' => $date,
                    'users' => $users,
                    'absensis' => $absensis
                ]);
            }
        }else{
            abort(403);
        }
    }
}
