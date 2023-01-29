<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use App\Http\Requests\StoreSekolahRequest;
use App\Http\Requests\UpdateSekolahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_sekolah|add_sekolah|edit_sekolah|delete_sekolah', ['only' => ['index','show']]);
         $this->middleware('permission:add_sekolah', ['only' => ['create','store']]);
         $this->middleware('permission:edit_sekolah', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_sekolah', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Sekolah::all();

        return view('sekolah.index', [
            'schools' => $schools
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSekolahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
       abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSekolahRequest  $request
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSekolahRequest $request, Sekolah $sekolah)
    {
        $data =[
            'nama' => $request->nama,
            'npsn' => $request->npsn,
            'kepala_sekolah' => $request->kepala_sekolah,
            'alamat' => $request->alamat,
        ];

        if ($request->instagram) {
            $data += ['instagram' => $request->instagram];
        }
        
        if ($request->youtube) {
            $data += ['youtube' => $request->youtube];
        }

        if ($request->logo) {
            if ($sekolah->logo != '/img/tutwuri.png	') {
                Storage::delete($sekolah->logo);
            }
            $data += ['logo' => $request->file('logo')->store('logo')];
        }

        $sekolah->update($data);

        return redirect('/dashboard')->with('msg_success', 'Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        foreach ($sekolah->absensi_pelajaran as $key => $absensi_pelajaran) {
            foreach ($absensi_pelajaran->presensi as $key => $presensi) {
                $presensi->delete();
            }
    
            $absensi_pelajaran->delete();
        }

        foreach ($sekolah->kelompok as $key => $kelompok) {
            $kelompok->user()->sync([]);
            $kelompok->kelompok_jadwal()->delete();
            $kelompok->delete();
        }

        foreach ($sekolah->user as $key => $user) {
            User::deleteUser($user->getRoleNames()[0], $user->id);
        }

        foreach ($sekolah->kelas as $key => $kelas) {
            foreach ($kelas->agenda as $key => $agenda) {
                $agenda->delete();
            }
            $kelas->delete();
        }

        foreach ($sekolah->kompetensi as $key => $kompetensi) {
            $kompetensi->delete();
        }

        foreach ($sekolah->mapel as $key => $mapel) {
            foreach ($mapel->agenda as $key => $agenda) {
                $agenda->delete();
            }
            $mapel->delete();
        }

        foreach ($sekolah->waktu_pelajaran as $key => $waktu_pelajaran) {
            foreach ($waktu_pelajaran->agenda as $key => $agenda) {
                $agenda->delete();
            }
            $waktu_pelajaran->delete();
        }

        foreach ($sekolah->tingkat as $key => $tingkat) {
            $sekolah->tingkat()->sync([]);
        }

        $sekolah->delete();

        return redirect()->back()->with('msg_success', 'Sekolah berhasil dihapus');
    }
}
