<?php

namespace App\Http\Controllers;

use DB, Auth;
use App\Models\TahunAjaran;
use App\Models\KelompokJadwal;
use App\Http\Requests\StoreKelompokJadwalRequest;
use App\Http\Requests\UpdateKelompokJadwalRequest;
use Illuminate\Validation\ValidationException;

class KelompokJadwalController extends Controller
{
    private function check($id){
        $kelompok = DB::table('kelompoks')->where('id', $id)->first();

        if (!$kelompok || $kelompok->sekolah_id != Auth::user()->sekolah_id) {
            return abort(403);
        }
    }

    public function create($id)
    {
        $this->check($id);
        return view('kelompok_jadwal.create', compact('id'));
    }

    public function store(StoreKelompokJadwalRequest $request)
    {
        $this->check($request->kelompok_id);

        $kelompok = DB::table('kelompok_jadwals')->where('hari', $request->hari)->first();

        if ($kelompok) {
            return throw ValidationException::withMessages(['msg_error' => 'sudah ada jadwal pada hari ' . $request->hari]);
        }

        KelompokJadwal::create([
            'kelompok_id' => $request->kelompok_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'hari' => $request->hari,
        ]);
        return TahunAjaran::redirectWithTahunAjaranManual(route('kelompok.show', $request->kelompok_id), $request, 'Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $this->check($id);
        $data = KelompokJadwal::findOrFail($id);
        return view('kelompok_jadwal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKelompokJadwalRequest  $request
     * @param  \App\Models\KelompokJadwal  $kelompokJadwal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKelompokJadwalRequest $request, KelompokJadwal $kelompokJadwal, $id)
    {
        $kelompokJadwal = KelompokJadwal::findOrFail($id);
        $this->check($kelompokJadwal->kelompok->id);
        $kelompokJadwal->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'hari' => $request->hari,
        ]);
        return TahunAjaran::redirectWithTahunAjaranManual(route('kelompok.show', $kelompokJadwal->kelompok->id), $request, 'Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelompokJadwal  $kelompokJadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompokJadwal = KelompokJadwal::findOrFail($id);
        $kelompokJadwal->delete();
        return redirect()->back()->with('msg_success', 'Berhasil dihapus');
    }
}
