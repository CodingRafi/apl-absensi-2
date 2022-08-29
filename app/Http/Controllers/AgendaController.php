<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Agenda;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
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
    public function destroy(Agenda $agenda)
    {
        //
    }

    public function get_mapel($id){
        $user = User::findOrFail($id);
        return $user->mapel;
    }

    public function showJadwal($id){
        $kelas = Kelas::findOrFail($id);
        $agendas = $kelas->agenda->groupBy('hari');

        return view('agenda.sigleJadwal',[
            'kelas' => $kelas,
            'agendas' => $agendas
        ]);
    }
}
