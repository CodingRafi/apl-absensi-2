<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\JedaPresensi;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreJedaPresensiRequest;
use App\Http\Requests\UpdateJedaPresensiRequest;

class JedaPresensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_jeda_presensi|add_jeda_presensi|edit_jeda_presensi|delete_jeda_presensi', ['only' => ['index','store']]);
         $this->middleware('permission:add_jeda_presensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_jeda_presensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_jeda_presensi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jedas = JedaPresensi::where('sekolah_id', \Auth::user()->sekolah->id)->get();
        return view('jeda_waktu.index', [
            'jedas' => $jedas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('jeda_waktu.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJedaPresensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJedaPresensiRequest $request)
    {
        $data = [
            'nama' => $request->nama,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'sekolah_id' => \Auth::user()->sekolah->id,
        ];
        
        if ($request->user == 'siswa') {
            $data += ['siswa' => '1'];
        }else{
            $data += ['role_id' => $request->user];
        }

        JedaPresensi::create($data);

        return TahunAjaran::redirectTahunAjaran('/tenggat', $request, 'Tenggat Waktu Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JedaPresensi  $jedaPresensi
     * @return \Illuminate\Http\Response
     */
    public function show(JedaPresensi $jedaPresensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JedaPresensi  $jedaPresensi
     * @return \Illuminate\Http\Response
     */
    public function edit(JedaPresensi $jedaPresensi, $id)
    {
        $jedaPresensi = JedaPresensi::findOrFail($id);
        return view('jeda_waktu.update', [
            'jeda' => $jedaPresensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJedaPresensiRequest  $request
     * @param  \App\Models\JedaPresensi  $jedaPresensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJedaPresensiRequest $request, JedaPresensi $jedaPresensi, $id)
    {
        $jedaPresensi = JedaPresensi::findOrFail($id);

        $jedaPresensi->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
        ]);

        return TahunAjaran::redirectTahunAjaran('/tenggat', $request, 'Tenggat Waktu Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JedaPresensi  $jedaPresensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $jedaPresensi = JedaPresensi::findOrFail($id);
        if ($jedaPresensi->role_id) {
            foreach ($jedaPresensi->user as $key => $user) {
                $user->update([
                    'jeda_presensi_id' => null
                ]);
            }
        } else {
            foreach ($jedaPresensi->siswa_relasi as $key => $siswa) {
                $siswa->update([
                    'jeda_presensi_id' => null
                ]);
            }
        }

        $jedaPresensi->delete();
        
        return TahunAjaran::redirectTahunAjaran('/tenggat', $request, 'Tenggat Waktu Berhasil Dihapus');
    }
}
