<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Agenda;
use App\Models\TahunAjaran;
use App\Models\AbsensiPelajaran;
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
         $this->middleware('permission:show_agenda_guru', ['only' => ['show_guru']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        
        if ($tahun_ajaran) {
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        }else{
            $classes = [];    
        }
        return view('agenda.index', [
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_query = User::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $gurus = [];

        foreach ($user_query as $key => $user) {
            if($user->hasRole('guru')){
                $gurus[] = $user;
            }
        }

        $kelas = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('agenda.create', [
            'gurus' => $gurus,
            'classes' => $kelas
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

        Agenda::create([
            'user_id' => $request->user_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'hari' => $request->hari,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'urutan' => $request->urutan,
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

        return TahunAjaran::redirectTahunAjaran('/agenda/kelas/' . $request->kelas_id, $request, 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        $user_query = User::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $gurus = [];

        foreach ($user_query as $key => $user) {
            if($user->hasRole('guru')){
                $gurus[] = $user;
            }
        }

        return view('agenda.update', [
            'agenda' => $agenda,
            'gurus' => $gurus
        ]);
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
        $agenda->update([
            'user_id' => $request->user_id,
            'mapel_id' => $request->mapel_id,
            'hari' => $request->hari,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'urutan' => $request->urutan,
        ]);

        return TahunAjaran::redirectTahunAjaran('/agenda/kelas/' . $agenda->kelas_id, $request, 'Jadwal Berhasil Diupdate');
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
        $agendas = Agenda::where('kelas_id', $agenda->kelas_id)->where('user_id', $agenda->user_id)->where('kelas_id', $agenda->kelas_id)->count();

        if ($agendas-1 < 1) {
            $absensi_pelajaran = AbsensiPelajaran::where('kelas_id', $agenda->kelas_id)->where('user_id', $agenda->user_id)->where('kelas_id', $agenda->kelas_id)->first();
            foreach ($absensi_pelajaran->presensi as $key => $presensi) {
                $presensi->delete();
            }

            $absensi_pelajaran->delete();
        }
        
        $agenda->delete();
        return TahunAjaran::redirectTahunAjaran('/agenda/kelas/' . $agenda->kelas_id, $request, 'Jadwal Berhasil Dihapus');
    }

    public function get_mapel($id){
        $user = User::findOrFail($id);
        return $user->mapel;
    }

    public function showJadwal($id){
        $haris = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $kelas = Kelas::findOrFail($id);
        $agendas = [];

        foreach ($haris as $key => $hari) {
            $agenda = Agenda::get_agenda($id, $hari);
            $agendas[$hari] = $agenda;
        }

        return view('agenda.sigleJadwal',[
            'kelas' => $kelas,
            'agendas' => $agendas
        ]);
    }

    public function show_guru(Request $request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        $now = Carbon::now();
        $month = $request->idb ?? $now->month;
        $day = $request->idt ?? $now->day;
        $year = $tahun_ajaran->tahun_awal;

        $dates=[];
        
        for($d=0; $d<=32; $d++)
        {
            $time=mktime(24, 0, 0, $month, $d, $year);  
            if (date('m', $time)==$month)       
            $dates[]=date('Y-m-d', $time);
        }

        $date = Carbon::parse(date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)))->locale('id')->isoFormat('dddd');

        $agendas = Agenda::where('tahun_ajaran_id', $tahun_ajaran->id)->where('hari', strtolower($date))->orderBy('urutan', 'asc')->get();

        // dd($agendas);

        return view('agenda.guru', [
            'agendas' => $agendas,
            'dates' => $dates
        ]);
    }
}
