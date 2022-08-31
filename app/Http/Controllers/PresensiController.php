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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

        foreach ($siswas as $key => $siswa) {
            $absensis[] = Absensi::get_absensi($siswa, $date);
        }

        return view('absensipelajaran.input', [
            'date' => $date,
            'kompetensis' => $kompetensis,
            'absensis' => $absensis,
            'siswas' => $siswas
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
        //
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
    public function update(UpdatePresensiRequest $request, Presensi $presensi)
    {
        //
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
