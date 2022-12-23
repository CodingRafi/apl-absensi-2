<?php

namespace App\Http\Controllers;

use App\Models\profile_user;
use App\Http\Requests\Storeprofile_userRequest;
use App\Http\Requests\Updateprofile_userRequest;

class ProfileUserController extends Controller
{
    public function store($user, $request, $role)
    {
        if($role == 'guru'){
            $user->mapel()->attach($request->mapel);
        }

        profile_user::create([
            'user_id' => $user->id,
            'name' => $request->name,
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

    public function update($user, $request, $role){
        if($role == 'guru'){
            $user->mapel()->sync($request->mapel);
        }

        $user->profile_user->update([
            'user_id' => $user->id,
            'name' => $request->name,
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
