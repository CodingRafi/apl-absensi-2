<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('mapel.index', [
            'mapels' => $mapels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMapelRequest $request)
    {
        Mapel::create([
            'nama' => $request->nama,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectTahunAjaran('/mapel', $request,  'Berhasil menambahkan mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        return view('mapel.update', [
            'mapel' => $mapel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMapelRequest  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        $mapel->update([
            'nama' => $request->nama
        ]);
        
        return TahunAjaran::redirectTahunAjaran('/mapel', $request,  'Berhasil mengupdate mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //
    }
}
