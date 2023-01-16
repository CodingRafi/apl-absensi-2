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
         $this->middleware('permission:view_agenda|add_agenda|edit_agenda|delete_agenda', ['only' => ['index','show']]);
         $this->middleware('permission:add_agenda', ['only' => ['create','store']]);
         $this->middleware('permission:edit_agenda', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_agenda', ['only' => ['destroy']]);
         $this->middleware('permission:show_agenda_user', ['only' => ['show_agenda_user']]);
    }

    private function check($id){
        if (!Auth::user()->hasRole('admin')) {
            if (Auth::user()->id != $id) {
                abort(403);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role){
        if (!Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $return = [
            'role' => $role
        ];

        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $classes = Kelas::getKelas($request);
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
        $this->check($id);
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $jam_pelajarans = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $return = ['role' => $role, 'jam_pelajarans' => $jam_pelajarans];

        if ($role == 'siswa') {
            $data = Kelas::findOrFail($id);
            $gurus = User::select('users.*')->role('guru')->where('users.sekolah_id', Auth::user()->sekolah_id)->get();
            $return += ['gurus' => $gurus];
        }elseif($role == 'guru'){
            $data = User::findOrFail($id);
            $kelas = Kelas::getKelas($request);
            $return += ['kelas' => $kelas];
        }else{
            $data = User::findOrFail($id);
        }

        $return += ['data' => $data];

        return view('agenda.create', $return);
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
        $this->check($id);
        $this->check_user($id, ($role == 'siswa' ? 'kelas' : $role));
        $agendas = Agenda::get_agenda($id, $role);

        return view('agenda.show',  [
            'role' => $role,
            'agendas' => $agendas,
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
        $this->check($agenda->user_id);
        $jam_pelajarans = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $return = ['agenda' => $agenda, 'role' => $role, 'jam_pelajarans' => $jam_pelajarans];

        if ($role == 'siswa') {
            $gurus = User::select('users.*')->role('guru')->join('sekolahs', 'sekolahs.id', 'users.sekolah_id')->where('users.sekolah_id', Auth::user()->sekolah_id)->get();
            $return += ['gurus' => $gurus];
        }elseif($role == 'guru'){
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $classes = Kelas::getKelas($request);
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
        $this->check($agenda->user_id);
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

    public function show_agenda_user(Request $request){
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        $agendas = Agenda::get_agenda($user->id, $role);

        return view('agenda.show',  [
            'role' => $role,
            'agendas' => $agendas,
            'id' => $user->id
        ]);
    }
}
