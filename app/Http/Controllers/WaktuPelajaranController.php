<?php

namespace App\Http\Controllers;

use App\Models\WaktuPelajaran;
use App\Models\WaktuIstirahat;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreWaktuPelajaranRequest;
use App\Http\Requests\UpdateWaktuPelajaranRequest;

class WaktuPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jams = WaktuPelajaran::get_wapel();
        $jam_pelajaran_for_istirahat = WaktuPelajaran::get_wapel_is_null();
        $japel = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $waktu_istirahats = WaktuIstirahat::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('jamPelajaran.index', compact('jams', 'jam_pelajaran_for_istirahat', 'waktu_istirahats', 'japel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWaktuPelajaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaktuPelajaranRequest $request)
    {
        for ($i=1; $i <= env('JUMLAH_JAM_MAPEL'); $i++) { 
            if ($request->input('jam_awal_' . $i)) {
                $waktu_pelajaran = WaktuPelajaran::where('jam_ke', $i)->where('sekolah_id', \Auth::user()->sekolah_id)->first();
                if ($waktu_pelajaran) {
                    $waktu_pelajaran->update([
                        'jam_awal' => $request->input('jam_awal_' . $i),
                        'jam_akhir' => ($request->input('jam_akhir_' . $i)) ? $request->input('jam_akhir_' . $i) : '00:00'
                    ]);
                }else{
                    WaktuPelajaran::create([
                        'sekolah_id' => \Auth::user()->sekolah->id,
                        'jam_ke' => $i,
                        'jam_awal' => $request->input('jam_awal_' . $i),
                        'jam_akhir' => ($request->input('jam_akhir_' . $i)) ? $request->input('jam_akhir_' . $i) : '00:00'
                    ]);
                }
            }
        }

        return TahunAjaran::redirectWithTahunAjaran(route('jam-pelajaran.index'), $request,  'Perubahan Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaktuPelajaranRequest  $request
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaktuPelajaranRequest $request, WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaktuPelajaran $waktuPelajaran, $id)
    {
        $waktuPelajaran = WaktuPelajaran::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Berhasil Direset'
        ], 200);
    }
}
