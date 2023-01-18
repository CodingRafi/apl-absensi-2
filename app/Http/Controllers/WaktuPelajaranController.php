<?php

namespace App\Http\Controllers;

use App\Models\WaktuPelajaran;
use App\Models\WaktuIstirahat;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreWaktuPelajaranRequest;
use App\Http\Requests\UpdateWaktuPelajaranRequest;

class WaktuPelajaranController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_waktu_pelajaran', ['only' => ['index','show']]);
         $this->middleware('permission:add_waktu_pelajaran', ['only' => ['create','store']]);
         $this->middleware('permission:edit_waktu_pelajaran', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_waktu_pelajaran', ['only' => ['destroy']]);
    }

    public function index()
    {
        $jams = WaktuPelajaran::get_wapel();
        $jam_pelajaran_for_istirahat = WaktuPelajaran::get_wapel_is_null();
        $japel = WaktuPelajaran::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $waktu_istirahats = WaktuIstirahat::where('sekolah_id', \Auth::user()->sekolah_id)->get();

        return view('jamPelajaran.index', compact('jams', 'jam_pelajaran_for_istirahat', 'waktu_istirahats', 'japel'));
    }

    public function create(){
        abort(404);
    }

    public function store(StoreWaktuPelajaranRequest $request)
    {
        for ($i=1; $i <= config('services.jml_jam_mapel'); $i++) { 
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

        return TahunAjaran::redirectWithTahunAjaranManual(route('jam-pelajaran.index'), $request,  'Perubahan Tersimpan');
    }

    public function edit(){
        abort(404);
    }

    public function update(){
        abort(404);
    }

    public function destroy(WaktuPelajaran $waktuPelajaran, $id)
    {
        $waktuPelajaran = WaktuPelajaran::findOrFail($id);
        if ($waktuPelajaran->waktu_istirahat) {
            $waktuPelajaran->waktu_istirahat->delete();
        }
        $waktuPelajaran->delete();
        return response()->json([
            'msg_success' => 'Berhasil Direset'
        ], 200);
    }
}
