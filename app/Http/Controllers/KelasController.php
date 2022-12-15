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
    function __construct()
    {
         $this->middleware('permission:view_kelas|add_kelas|edit_kelas|delete_kelas', ['only' => ['index','store']]);
         $this->middleware('permission:add_kelas', ['only' => ['create','store']]);
         $this->middleware('permission:edit_kelas', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_kelas', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->when($tahun_ajaran, function ($query) use($tahun_ajaran) {
            $query->where('tahun_ajaran_id', $tahun_ajaran->id);
        })->get(); 

        return view('kelas.index', [
            'classes' => $classes 
        ]);

    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(StoreKelasRequest $request)
    {   
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        Kelas::create([
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'nama' => $request->nama,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Ditambahkan');
    }

    public function show(Kelas $kelas)
    {
        abort(404);
    }

    public function edit(Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            return view('kelas.update', [
                'kelas' => $kelas
            ]);
        }

        abort(403);
    }

    public function update(UpdateKelasRequest $request, Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            $kelas->update([
                'nama' => $request->nama
            ]);
    
            return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Diupdate');
        }

        abort(403);
    }

    public function destroy(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            foreach ($kelas->siswa as $key => $siswa) {
                Siswa::deleteSiswa($siswa->id);
            }
    
            foreach ($kelas->agenda as $key => $agenda) {
                $agenda->delete();
            }
    
            $kelas->delete();
    
            return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Dihapus');
        }

        abort(403);
    }
}
