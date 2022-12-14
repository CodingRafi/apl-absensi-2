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
    
    public function index()
    {
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('kompetensi.index', [
            'kompetensis' => $kompetensis
        ]);
    }

    public function create()
    {
        return view('kompetensi.create');
    }

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

    public function show(Kompetensi $kompetensi)
    {
        //
    }

    public function edit(Kompetensi $kompetensi)
    {
        return view('kompetensi.update', [
            'kompetensi' => $kompetensi
        ]);
    }

    public function update(UpdateKompetensiRequest $request, Kompetensi $kompetensi)
    {
        $kompetensi->update([
            'kompetensi' => $request->kompetensi,
            'bidang' => $request->bidang,
            'program' => $request->program,
        ]);

        return TahunAjaran::redirectWithTahunAjaran('kompetensi.index', $request, 'Berhasil Mengupdate Kompetensi');
    }

    public function destroy(Request $request, $id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        foreach ($kompetensi->siswa as $key => $siswa) {
            Siswa::deleteSiswa($siswa->id);
        }

        $kompetensi->delete();
        return TahunAjaran::redirectWithTahunAjaran('kompetensi.index', $request, 'Berhasil meghapus Kompetensi');
    }
}
