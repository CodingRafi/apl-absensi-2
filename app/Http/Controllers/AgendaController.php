<?php

namespace App\Http\Controllers;

use Auth;
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
    public function create(Request $request, $role, $id)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $jam_pelajarans = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        if ($role == 'siswa') {
            $data = Kelas::findOrFail($id);
            $gurus = User::select('users.*')->role('guru')->where('users.sekolah_id', Auth::user()->sekolah_id)->get();
        }elseif($role == 'guru'){
            $data = User::findOrFail($id);
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        }else{
            $data = User::findOrFail($id);
        }

        return view('agenda.create', [
            'role' => $role,
            'gurus' => isset($gurus) ? $gurus : [],
            'jam_pelajarans' => $jam_pelajarans,
            'classes' => isset($classes) ? $classes : [],
            'data' => $data
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
                'mapel_id' => 'required'
            ]);
            
            $data = [
                'mapel_id' => $request->mapel_id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'hari' => $request->hari,
                'waktu_pelajaran_id' => $request->waktu_pelajaran_id,
            ];
            
            if ($request->role == 'siswa') {
                $request->validate(['user_id' => 'required']);
                $data += [
                    'user_id' => $request->user_id,
                    'kelas_id' => $request->id,
                ];
            }else{
                $request->validate(['kelas_id' => 'required']);
                $data += [
                    'user_id' => $request->id,
                    'kelas_id' => $request->kelas_id,
                ];
            }

            $agenda = Agenda::create($data);
    
            $agenda_check = Agenda::where('kelas_id', $agenda->kelas_id)
                            ->where('user_id', $agenda->user_id)
                            ->count();
    
            if ($agenda_check == 1) {
                AbsensiPelajaran::create([
                    'tahun_ajaran_id' => $tahun_ajaran->id,
                    'kelas_id' => $request->id,
                    'user_id' => $request->user_id,
                    'mapel_id' => $request->mapel_id,
                    'sekolah_id' => \Auth::user()->sekolah_id
                ]);
            }
        }else{
            Agenda::create([
                'user_id' => $request->id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'hari' => $request->hari,
                'waktu_pelajaran_id' => $request->waktu_pelajaran_id,
                'other' => $request->other
            ]);
        }
        
        return TahunAjaran::redirectWithTahunAjaranManual(route('agenda.show', ['role' => $request->role, 'id' => $request->id]), $request, 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $this->check_user($id, $role);
        $agendas = Agenda::get_agenda($id, $role);
        $data = ($role == 'siswa') ? Kelas::findOrFail($id) : User::findOrFail($id);

        return view('agenda.show',  [
            'role' => $role,
            'agendas' => $agendas,
            'data' => $data
        ]);
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
        $jam_pelajarans = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $return = ['agenda' => $agenda, 'role' => $role, 'jam_pelajarans' => $jam_pelajarans];

        if ($role == 'siswa') {
            $gurus = User::select('users.*')->role('guru')->join('sekolahs', 'sekolahs.id', 'users.sekolah_id')->where('users.sekolah_id', Auth::user()->sekolah_id)->get();
            $return += ['gurus' => $gurus];
        }elseif($role == 'guru'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $return += ['classes' => $classes];
        }

        return view('agenda.update', $return);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgendaRequest  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgendaRequest $request, Agenda $agenda, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $data = [
            'hari' => $request->hari,
            'waktu_pelajaran_id' => $request->waktu_pelajaran_id,
        ];

        $mapel_old = $agenda->mapel;

        if ($request->role == 'siswa') {            
            $absensi_pelajaran = AbsensiPelajaran::where('kelas_id', $agenda->kelas_id)->where('mapel_id', $mapel_old->id)->first();
            $data += ['user_id' => $request->user_id,'mapel_id' => $request->mapel_id];
        } elseif($request->role == 'guru') {
            $data += ['kelas_id' => $request->kelas_id,'mapel_id' => $request->mapel_id];
        }else{
            $data += ['other' => $request->other];
        }

        $agenda->update($data);
        
        if ($request->role == 'siswa') {
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
            return TahunAjaran::redirectWithTahunAjaranManual(route('agenda.show', ['role' => $request->role, 'id' => $agenda->kelas_id]), $request, 'Jadwal Berhasil Diupdate');
        }else{
            return TahunAjaran::redirectWithTahunAjaranManual(route('agenda.show', ['role' => $request->role, 'id' => $agenda->user_id]), $request, 'Jadwal Berhasil Diupdate');
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
                if (count($absensi_pelajaran->presensi) > 0) {
                    foreach ($absensi_pelajaran->presensi as $key => $presensi) {
                        $presensi->delete();
                    }
                }
    
                $absensi_pelajaran->delete();
            }
        }
        
        $agenda->delete();

        if ($request->role == 'siswa') {
            return TahunAjaran::redirectWithTahunAjaranManual(route('agenda.show', ['role' => $request->role, 'id' => $agenda->kelas_id]), $request, 'Jadwal Berhasil Dihapus');
        }else{
            return TahunAjaran::redirectWithTahunAjaranManual(route('agenda.show', ['role' => $request->role, 'id' => $agenda->user_id]), $request, 'Jadwal Berhasil Dihapus');
        }
    }

    public function get_mapel($id){
        $user = User::findOrFail($id);
        return response()->json([
            'data' => $user->mapel
        ], 200);
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
