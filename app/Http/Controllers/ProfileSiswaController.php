<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\profile_siswa;
use App\Http\Requests\Storeprofile_siswaRequest;
use App\Http\Requests\Updateprofile_siswaRequest;

class ProfileSiswaController extends Controller
{
    public function store($user, $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        profile_siswa::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'nisn' => $request->nisn,
            'nipd' => $request->nipd,
            'nik' => $request->nik,
            'kelas_id' => $request->kelas_id,
            'kompetensi_id' => $request->kompetensi_id,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'ref_agama_id' => $request->ref_agama_id,
            'ref_provinsi_id' => $request->ref_provinsi_id,
            'ref_kabupaten_id' => $request->ref_kabupaten_id,
            'ref_kecamatan_id' => $request->ref_kecamatan_id,
            'ref_kelurahan_id' => $request->ref_kelurahan_id,
            'jalan' => $request->jalan,
            'tahun_ajaran_id' => $tahun_ajaran->id
        ]);
    }

    public function update($user, $request){
        $user->profile_siswa->update([
            'name' => $request->name,
            'nisn' => $request->nisn,
            'nipd' => $request->nipd,
            'nik' => $request->nik,
            'kelas_id' => $request->kelas_id,
            'kompetensi_id' => $request->kompetensi_id,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'ref_agama_id' => $request->ref_agama_id,
            'ref_provinsi_id' => $request->ref_provinsi_id,
            'ref_kabupaten_id' => $request->ref_kabupaten_id,
            'ref_kecamatan_id' => $request->ref_kecamatan_id,
            'ref_kelurahan_id' => $request->ref_kelurahan_id,
            'jalan' => $request->jalan,
        ]);
    }
}
