<?php

namespace App\Http\Controllers;

use App\Models\WaktuIstirahat;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWaktuIstirahatRequest;
use App\Http\Requests\UpdateWaktuIstirahatRequest;

class WaktuIstirahatController extends Controller
{
    public function store(StoreWaktuIstirahatRequest $request)
    {
        WaktuIstirahat::create([
            'waktu_pelajaran_id' => $request->waktu_pelajaran_id,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectWithTahunAjaranManual(route('jam-pelajaran.index'), $request,  'Jam Istirahat Berhasil Tersimpan');
    }

    public function update(UpdateWaktuIstirahatRequest $request, WaktuIstirahat $waktuIstirahat, $id)
    {
        $waktuIstirahat = WaktuIstirahat::findOrFail($id);
        $waktuIstirahat->update([
            'waktu_pelajaran_id' => $request->waktu_pelajaran_id,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
        ]);
        return TahunAjaran::redirectWithTahunAjaranManual(route('jam-pelajaran.index'), $request,  'Jam Istirahat Berhasil Diubah');
    }

    public function destroy(Request $request, $id)
    {
        $waktuIstirahat = WaktuIstirahat::findOrFail($id)->delete();
        return TahunAjaran::redirectWithTahunAjaranManual(route('jam-pelajaran.index'), $request,  'Jam Istirahat Berhasil Dihapus');
    }
}
