<?php

namespace App\Http\Controllers;

use DB, Auth;
use App\Models\User;
use App\Models\Presensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\AbsensiPelajaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiPelajaranExport;
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
         $this->middleware('permission:export_absensi_pelajaran', ['only' => ['export']]);
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
        return view('absensi_pelajaran.form');
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
    public function edit($id)
    {
        $data = AbsensiPelajaran::findOrFail($id);
        return view('absensi_pelajaran.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiPelajaranRequest  $request
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiPelajaran $absensiPelajaran, $id)
    {
        $absensiPelajaran = AbsensiPelajaran::findOrFail($id);

        if ($absensiPelajaran->nama == $request->nama && $absensiPelajaran->mapel_id == $request->mapel_id && $absensiPelajaran->kelas_id == $request->kelas_id) {
            return redirect()->back()->with('msg_error', 'Tidak ada perubahan terdeteksi');
        }

        $check = AbsensiPelajaran::where('user_id', Auth::user()->id)
                                    ->where('kelas_id', $request->kelas_id)
                                    ->where('mapel_id', $request->mapel_id)
                                    ->first();
        if ($check) {
            return redirect()->back()->with('msg_error', 'absensi pelajaran sudah ada');
        }
        
        if ($absensiPelajaran->user_id != Auth::user()->id) {
            abort(403);
        }

        if ($request->kelas_id != $absensiPelajaran->kelas_id || $request->mapel_id != $absensiPelajaran->mapel_id) {
            $absensiPelajaran->presensi()->delete();
        }

        $absensiPelajaran->update([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
        ]);
        
        return redirect()->route('absensi-pelajaran.index')->with('msg_success', 'Berhasil terupdate');
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

        if ($request->method == 'update') {
            
        }

        $kelas = DB::table('agendas')
                            ->select('kelas.*')
                            ->join('kelas', 'kelas.id', 'agendas.kelas_id')
                            ->leftJoin('absensi_pelajarans', function($join) use($request){
                                $join->on('absensi_pelajarans.kelas_id', 'kelas.id')
                                    ->where('absensi_pelajarans.mapel_id', $request->mapel_id)
                                    ->where('absensi_pelajarans.user_id', Auth::user()->id);
                            })
                            ->where('agendas.tahun_ajaran_id', $tahun_ajaran->id)
                            ->when($request->method != 'update', function($q) use($request) {
                                $q->whereNull('absensi_pelajarans.kelas_id')
                                    ->whereNull('absensi_pelajarans.mapel_id');
                            })
                            ->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                            ->distinct('agendas.kelas_id')
                            ->get();
                            
        return response()->json([
            'datas' => $kelas
        ], 200);
    }

    public function export(Request $request, $id){
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
        return Excel::download(new AbsensiPelajaranExport($absensi_pelajaran, $absensis, $date, $status_kehadiran), 'absensi-pelajaran.xlsx');
    }
}
