<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Http\Requests\StoreSekolahRequest;
use App\Http\Requests\UpdateSekolahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_sekolah|add_sekolah|edit_sekolah|delete_sekolah', ['only' => ['index','store']]);
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
        return view('sekolah.edit');
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
            $absensi_pelajaran->delete();
        }

        foreach ($sekolah->user as $key => $user) {
            if ($user->hasRole('guru')) {
                if (count($user->mapel) > 0) {
                    foreach ($user->mapel as $key => $mapel) {
                        $mapel->user()->detach($user->id);
                    }
                }
    
                if(count($user->agenda) > 0){
                    foreach ($user->agenda as $key => $agenda) {
                        $agenda->delete();
                    }
                }
            }
    
            
            if (count($user->absensi) > 0) {
                foreach ($user->absensi as $key => $absensi) {
                    $absensi->delete();
                }
            }
    
            if ($user->rfid) {
                $user->rfid->delete();
            }
    
            $user->delete();
        }

        foreach ($sekolah->kelas as $key => $kelas) {
            foreach ($kelas->siswa as $key => $siswa) {
                if ($siswa->rfid) {
                    $siswa->rfid->delete();
                }
                foreach ($siswa->absensi as $key => $absensi) {
                    $absensi->delete();
                }
                $siswa->delete();
            }
    
            foreach ($kelas->agenda as $key => $agenda) {
                $agenda->delete();
            }
    
            $kelas->delete();
    
        }

        foreach ($sekolah->kompetensi as $key => $kompetensi) {
            if (count($kompetensi->siswa) > 0) {
                foreach ($kompetensi->siswa as $key => $siswa) {
                    if ($siswa->rfid) {
                        $siswa->rfid->delete();
                    }
                    foreach ($siswa->absensi as $key => $absensi) {
                        $absensi->delete();
                    }
                    $siswa->delete();
                }
            }
    
            $kompetensi->delete();
        }

        foreach ($sekolah->mapel as $key => $mapel) {
            foreach ($mapel->user as $key => $guru) {
                $guru->mapel()->detach($id);
            }
    
            foreach ($mapel->agenda as $key => $agenda) {
                $agenda->delete();
            }
    
            $mapel->delete();
        }

        $sekolah->delete();

        return redirect()->back()->with('msg_success', 'Sekolah berhasil dihapus');

    }
}
