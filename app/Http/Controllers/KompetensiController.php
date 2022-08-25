<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use App\Http\Requests\StoreKompetensiRequest;
use App\Http\Requests\UpdateKompetensiRequest;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('kompetensi.index', [
            'kompetensis' => $kompetensis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kompetensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKompetensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKompetensiRequest $request)
    {
        Kompetensi::create([
            'kompetensi' => $request->kompetensi,
            'bidang' => $request->bidang,
            'program' => $request->program,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return redirect('/kompetensi')->with('message', 'Jurusan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function show(Kompetensi $kompetensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kompetensi $kompetensi)
    {
        return view('kompetensi.update', [
            'kompetensi' => $kompetensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKompetensiRequest  $request
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKompetensiRequest $request, Kompetensi $kompetensi)
    {
        $kompetensi->update([
            'kompetensi' => $request->kompetensi,
            'bidang' => $request->bidang,
            'program' => $request->program,
        ]);

        return redirect('/kompetensi')->with('message', 'Kompetensi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kompetensi $kompetensi)
    {
        //
    }
}
