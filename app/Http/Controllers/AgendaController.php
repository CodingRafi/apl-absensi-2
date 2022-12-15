<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Agenda;
use App\Models\TahunAjaran;
use App\Models\AbsensiPelajaran;
use App\Models\WaktuPelajaran;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_agenda|add_agenda|edit_agenda|delete_agenda', ['only' => ['index','store']]);
         $this->middleware('permission:add_agenda', ['only' => ['create','store']]);
         $this->middleware('permission:edit_agenda', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_agenda', ['only' => ['destroy']]);
         $this->middleware('permission:show_jadwal_guru', ['only' => ['show_jadwal']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role){
        $return = [
            'role' => $role
        ];

        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)
                        ->when($tahun_ajaran, function ($q) use ($tahun_ajaran) {
                            return $q->where('kelas.tahun_ajaran_id', $tahun_ajaran->id);
                        })->get();
            $return += [
                'classes' => $classes,
            ];
        }else{
            $users = User::role($role)->where('sekolah_id', \Auth::user()->sekolah->id)->get();
            $return += [
                'users' => $users
            ];
        }

        return view('agenda.index', $return);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $role)
    {
        $gurus = User::role('guru')->get();
        $jam_pelajarans = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        
        if (request('idu')) {
            $user = User::findOrFail(request('idu'));
        } else {
            $user = null;
        }

        return view('agenda.create', [
            'role' => $role,
            'gurus' => $gurus,
            'jam_pelajarans' => $jam_pelajarans,
            'classes' => $classes,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgendaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgendaRequest $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        if ($request->role == 'siswa' || $request->role == 'guru') {
            $request->validate([
                'kelas_id' => 'required',
                'mapel_id' => 'required'
            ]);

            Agenda::create([
                'user_id' => $request->user_id,
                'kelas_id' => $request->kelas_id,
                'mapel_id' => $request->mapel_id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'hari' => $request->hari,
                'jam_awal' => $request->jam_awal,
                'jam_akhir' => $request->jam_akhir,
            ]);
    
            $agenda = Agenda::where('kelas_id', $request->kelas_id)->where('user_id', $request->user_id)->where('kelas_id', $request->kelas_id)->count();
    
            if ($agenda == 1) {
                AbsensiPelajaran::create([
                    'tahun_ajaran_id' => $tahun_ajaran->id,
                    'kelas_id' => $request->kelas_id,
                    'user_id' => $request->user_id,
                    'mapel_id' => $request->mapel_id,
                    'sekolah_id' => \Auth::user()->sekolah_id
                ]);
            }
        }else{
            Agenda::create([
                'user_id' => $request->user_id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'hari' => $request->hari,
                'jam_awal' => $request->jam_awal,
                'jam_akhir' => $request->jam_akhir,
                'other' => $request->other
            ]);
        }

        if ($request->role == 'siswa') {
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $request->kelas_id, $request, 'Jadwal Berhasil Ditambahkan');
        }else{
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $request->user_id, $request, 'Jadwal Berhasil Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $haris = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $agendas = [];
        $returnData = [];

        if ($role == 'siswa') {
            $kelas = Kelas::findOrFail($id);
            
            foreach ($haris as $key => $hari) {
                $agenda = Agenda::get_agenda($id, $hari);
                $agendas[$hari] = $agenda;
            }

            $returnData = [
                'kelas' => $kelas,
                'agendas' => $agendas,
                'role' => $role
            ];
        }else{
            $user = User::findOrFail($id);
            foreach ($haris as $key => $hari) {
                $agendas[$hari] = Agenda::where('user_id', $user->id)->where('hari', $hari)->get();
            }

            $returnData = [
                'user' => $user,
                'agendas' => $agendas,
                'role' => $role
            ];
        }

        return view('agenda.sigleJadwal', $returnData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $role, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $returnData = ['agenda' => $agenda, 'role' => $role];

        if ($role == 'siswa') {
            $user_query = User::where('sekolah_id', \Auth::user()->sekolah_id)->get();
            $gurus = [];
    
            foreach ($user_query as $key => $user) {
                if($user->hasRole('guru')){
                    $gurus[] = $user;
                }
            }

            if (!$agenda->user_id) {
                $user_query_mapel = User::select('users.*')->join('mapel_user', 'users.id', 'mapel_user.user_id')->where('users.sekolah_id', \Auth::user()->sekolah_id)->where('mapel_user.mapel_id', $agenda->mapel_id)->first();

                if ($user_query_mapel) {
                    $returnData += ['user_query_mapel' => $user_query_mapel];
                }
            }
            
            $returnData += ['gurus' => $gurus];
        }elseif($role == 'guru'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();

            $returnData += ['classes' => $classes];
        }

        return view('agenda.update', $returnData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgendaRequest  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendaRequest $request, Agenda $agenda)
    {
        $updateData = [
            'hari' => $request->hari,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ];

        $mapel_old = $agenda->mapel;

        
        if ($request->role == 'siswa') {            
            $absensi_pelajaran = AbsensiPelajaran::where('kelas_id', $agenda->kelas_id)->where('mapel_id', $mapel_old->id)->first();
            $updateData += ['user_id' => $request->user_id,'mapel_id' => $request->mapel_id];
        } elseif($request->role == 'guru') {
            $updateData += ['kelas_id' => $request->kelas_id,'mapel_id' => $request->mapel_id];
        }else{
            $updateData += ['other' => $request->other];
        }

        $agenda->update($updateData);
        
        if ($request->role == 'siswa') {
            // dd($request->mapel_id);
            // dd($mapel_old->id);
            // dd($absensi_pelajaran);  
            // dd($mapel_old->id != $request->mapel_id);
            if ($mapel_old->id != $request->mapel_id) {
                $absensi_pelajaran->update([
                    'mapel_id' => $request->mapel_id,
                    'user_id' => $request->user_id
                ]);
            } else {
                $absensi_pelajaran->update([
                    'user_id' => $request->user_id
                ]);
            }
        }

        if ($request->role == 'siswa') {
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $agenda->kelas_id, $request, 'Jadwal Berhasil Diupdate');
        }else{
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $agenda->user_id, $request, 'Jadwal Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        if ($request->role == 'siswa' || $request->role == 'guru') {
            $agendas = Agenda::where('kelas_id', $agenda->kelas_id)->where('user_id', $agenda->user_id)->where('kelas_id', $agenda->kelas_id)->count();
            if ($agendas-1 < 1) {
                $absensi_pelajaran = AbsensiPelajaran::where('kelas_id', $agenda->kelas_id)->where('user_id', $agenda->user_id)->where('kelas_id', $agenda->kelas_id)->first();
                foreach ($absensi_pelajaran->presensi as $key => $presensi) {
                    $presensi->delete();
                }
    
                $absensi_pelajaran->delete();
            }
        }
        
        $agenda->delete();

        if ($request->role == 'siswa') {
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $agenda->kelas_id, $request, 'Jadwal Berhasil Diupdate');
        }else{
            return TahunAjaran::redirectWithTahunAjaran('/agenda/'. $request->role . '/' . $agenda->user_id, $request, 'Jadwal Berhasil Diupdate');
        }
    }

    public function get_mapel($id){
        $user = User::findOrFail($id);
        return $user->mapel;
    }

    public function show_guru(Request $request){
        // $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        // $now = Carbon::now();
        // $month = $request->idb ?? $now->month;
        // $day = $request->idt ?? $now->day;
        // $year = $tahun_ajaran->tahun_awal;

        // $dates=[];
        
        // for($d=0; $d<=32; $d++)
        // {
        //     $time=mktime(24, 0, 0, $month, $d, $year);  
        //     if (date('m', $time)==$month)       
        //     $dates[]=date('Y-m-d', $time);
        // }

        // $date = Carbon::parse(date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)))->locale('id')->isoFormat('dddd');

        // $agendas = Agenda::where('tahun_ajaran_id', $tahun_ajaran->id)->where('hari', strtolower($date))->orderBy('jam_awal', 'asc')->get();

        // return view('agenda.guru', [
        //     'agendas' => $agendas,
        //     'dates' => $dates
        // ]);

        // $users = [];
        // $usersQuery = User::where('sekolah_id', \Auth::user()->sekolah->id)->get();

        // foreach ($usersQuery as $key => $user) {
        //     if ($user->hasRole('guru')) {
        //         $users[] = $user;
        //     }
        // }

        // return view('agenda.index',[
        //     'role' => 'guru',
        //     'users' => $users
        // ]);
    }
}
