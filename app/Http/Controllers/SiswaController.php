<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $siswas = [];
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        foreach ($classes as $key => $kelas) {
            $siswas[] = $kelas->siswa;
        }

        return view('siswa.index',[
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
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }

    public function import(Request $request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('import', [
            'classes' => $classes,
            'kompetensis' => $kompetensis
        ]);
    }

    public function saveimport(Request $request){
        $siswas = (new FastExcel)->import($request->file);

        foreach ($siswas as $key => $siswa) {
            if ($key > 0) {
                Siswa::create([
                    'name' => $siswa['name'],
                    'nisn' => $siswa['nisn'],
                    'nipd' => $siswa['nipd'],
                    'jk' => ($siswa['jk'] == 'L' || $siswa['jk'] == 'P') ? $siswa['jk'] : null,
                    'tempat_lahir' => $siswa['tempat_lahir'],
                    'tanggal_lahir' => $siswa['tanggal_lahir'],
                    'nik' => $siswa['nik'],
                    'agama' => $siswa['agama'],
                    'jalan' => $siswa['jalan'],
                    'kelurahan' => $siswa['kelurahan'],
                    'kecamatan' => $siswa['kecamatan'],
                    'sekolah_id' => \Auth::user()->sekolah_id,
                    'kompetensi_id' => $request->kompetensi_id,
                    'kelas_id' => $request->kelas_id,
                ]);
            }
        }

        return redirect('/siswa');
    }
}
