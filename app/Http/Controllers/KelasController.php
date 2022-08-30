<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;

class KelasController extends Controller
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

        return view('kelas.index', [
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
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKelasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKelasRequest $request)
    {   
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        Kelas::create([
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'nama' => $request->nama,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectTahunAjaran('/kelas', $request, 'Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.update', [
            'kelas' => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKelasRequest  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama' => $request->nama
        ]);

        return TahunAjaran::redirectTahunAjaran('/kelas', $request, 'Kelas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        foreach ($kelas->siswa as $key => $siswa) {
            Siswa::deleteSiswa($siswa->id);
        }

        foreach ($kelas->agenda as $key => $agenda) {
            $agenda->delete();
        }

        $kelas->delete();

        return TahunAjaran::redirectTahunAjaran('/kelas', $request, 'Kelas Berhasil Dihapus');
    }
}
