<?php

namespace App\Http\Controllers;

use DB, Auth;
use App\Models\User;
use App\Models\Presensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\AbsensiPelajaran;
use App\Http\Requests\StoreAbsensiPelajaranRequest;
use App\Http\Requests\UpdateAbsensiPelajaranRequest;

class AbsensiPelajaranController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:view_absensi_pelajaran', ['only' => ['index','show']]);
         $this->middleware('permission:add_absensi_pelajaran', ['only' => ['create','store']]);
         $this->middleware('permission:edit_absensi_pelajaran', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_absensi_pelajaran', ['only' => ['destroy']]);
    }

    public function get_presensi($tahun_ajaran, $date){
        $users = User::select('users.*')
            ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
            ->join('kelas', 'profile_siswas.kelas_id', 'kelas.id')
            ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
            ->join('tahun_ajarans', 'tahun_ajarans.id', 'profile_siswas.tahun_ajaran_id')
            ->where('profile_siswas.tahun_ajaran_id', $tahun_ajaran->id)
            ->filterSiswa(request(['kelas', 'jurusan', 'search']))
            ->role('siswa') 
            ->where('users.sekolah_id', \Auth::user()->sekolah_id)
            ->get();

        $absensis = [];

        foreach ($users as $key => $user) {
            $absensis[] = Presensi::get_absensi($user, $date, $tahun_ajaran);
        }

        return $absensis;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        return view('absensi_pelajaran.index', [
            'absensi_pelajarans' => \Auth::user()->absensi_pelajaran->where('tahun_ajaran_id', $tahun_ajaran->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('absensi_pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbsensiPelajaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbsensiPelajaranRequest $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        AbsensiPelajaran::create([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'user_id' => Auth::user()->id,
            'sekolah_id' => Auth::user()->sekolah_id,
            'tahun_ajaran_id' => $tahun_ajaran->id
        ]);
        return redirect()->route('absensi-pelajaran.index')->with('msg_success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $absensi_pelajaran = AbsensiPelajaran::where('absensi_pelajarans.id', $id) 
                                                ->where('user_id', Auth::user()->id)
                                                ->first();
        
        if (!$absensi_pelajaran) {
            abort(403);
        }

        $status_kehadiran = DB::table('status_kehadirans')->get();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $date = $this->getdate();
        $absensis = $this->get_presensi($tahun_ajaran, $date);

        return view('absensi_pelajaran.show', compact('absensi_pelajaran', 'status_kehadiran', 'absensis', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiPelajaranRequest  $request
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbsensiPelajaranRequest $request, AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    public function get_kelas(Request $request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $kelas = DB::table('agendas')
                            ->select('kelas.*')
                            ->join('kelas', 'kelas.id', 'agendas.kelas_id')
                            ->leftJoin('absensi_pelajarans', function($join) use($request){
                                $join->on('absensi_pelajarans.kelas_id', 'kelas.id')
                                    ->where('absensi_pelajarans.mapel_id', $request->mapel_id)
                                    ->where('absensi_pelajarans.user_id', Auth::user()->id);
                            })
                            ->where('agendas.tahun_ajaran_id', $tahun_ajaran->id)
                            ->whereNull('absensi_pelajarans.kelas_id')
                            ->whereNull('absensi_pelajarans.mapel_id')
                            ->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                            ->distinct('agendas.kelas_id')
                            ->get();
                            
        return response()->json([
            'datas' => $kelas
        ], 200);
    }
}
