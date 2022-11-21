<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreKompetensiRequest;
use App\Http\Requests\UpdateKompetensiRequest;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_kompetensi|add_kompetensi|edit_kompetensi|delete_kompetensi', ['only' => ['index','store']]);
         $this->middleware('permission:add_kompetensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_kompetensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_kompetensi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->sekolah->tingkat == 'smk') {
            $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
    
            return view('kompetensi.index', [
                'kompetensis' => $kompetensis
            ]);
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( \Auth::user()->sekolah->tingkat == 'smk' ) {
            return view('kompetensi.create');
        }else{
            abort(403);
        }
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

        return TahunAjaran::redirectWithTahunAjaran('kompetensi.index', $request, 'Berhasil Menambahkan Kompetensi');
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
        if (\Auth::user()->sekolah->id == $kompetensi->sekolah_id) {
            return view('kompetensi.update', [
                'kompetensi' => $kompetensi
            ]);
        }else{
            abort(403);
        }
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
        if (\Auth::user()->sekolah->id == $kompetensi->sekolah_id) {
            $kompetensi->update([
                'kompetensi' => $request->kompetensi,
                'bidang' => $request->bidang,
                'program' => $request->program,
            ]);
    
            return TahunAjaran::redirectWithTahunAjaran('kompetensi.index', $request, 'Berhasil Mengupdate Kompetensi');
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        if (\Auth::user()->sekolah->id == $kompetensi->sekolah_id) {
            foreach ($kompetensi->siswa as $key => $siswa) {
                Siswa::deleteSiswa($siswa->id);
            }
    
            $kompetensi->delete();
            return TahunAjaran::redirectWithTahunAjaran('kompetensi.index', $request, 'Berhasil meghapus Kompetensi');
        }else{
            abort(403);
        }
    }
}
