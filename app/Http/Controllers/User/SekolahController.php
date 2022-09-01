<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\User;

class SekolahController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'alamat' => 'required',
            'tingkat' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $sekolah = Sekolah::create([
            'nama' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'alamat' => $request->alamat,
            'tingkat' => $request->tingkat,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'sekolah_id' => $sekolah->id
        ]);

        $user->assignRole('admin');

        if($request->name_yayasan && $request->email_yayasan){
            $yayasan = User::create([
                'name' => $request->name_yayasan,
                'email' => $request->email_yayasan,
                'password' => \Hash::make($request->password_yayasan),
                'sekolah_id' => $sekolah->id
            ]);

            $user->assignRole('yayasan');
        }

        return redirect('/login')->with('message', 'Berhasil registrasi');
    }
}
