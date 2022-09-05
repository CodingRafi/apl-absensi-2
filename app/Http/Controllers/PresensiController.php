<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\TahunAjaran;
use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_presensi|add_presensi|edit_presensi|delete_presensi', ['only' => ['index','store']]);
         $this->middleware('permission:add_presensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_presensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_presensi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
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
        }

        $presensis = [];

        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

        foreach ($siswas as $key => $siswa) {
            $presensis[] = Presensi::get_presensi($siswa, $date);
        }

        return view('absensipelajaran.input', [
            'date' => $date,
            'kompetensis' => $kompetensis,
            'presensis' => $presensis,
            'siswas' => $siswas,
            'id' => $id
        ]);
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
     * @param  \App\Http\Requests\StorePresensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresensiRequest $request)
    {
        $siswa = Siswa::findOrFail($request->siswa_id);

        $query = Absensi::where('siswa_id', $siswa->id)->whereDate('presensi_masuk', '=', $request->date)->first();

        if($query){
            // dd($query);
            Presensi::create([
                'absensi_pelajaran_id' => $request->absensi_pelajaran_id,
                'siswa_id' => $request->siswa_id,
                'absensi_id' => $query->id,
                'kehadiran' => $request->kehadiran,
                'tgl_kehadiran' => $request->date
            ]);

            return redirect('/presensi/'. $request->absensi_pelajaran_id . '/' .'?idk=' . $request->idk)->with('message', 'berhasil tersimpan');
        }else{
            return redirect('/presensi/'. $request->absensi_pelajaran_id . '/' .'?idk=' . $request->idk)->with('message', 'belum absensi masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresensiRequest  $request
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresensiRequest $request, Presensi $presensi, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $presensi->update([
            'kehadiran' => $request->kehadiran
        ]);

        return redirect()->back()->with('message', 'Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        //
    }
}
