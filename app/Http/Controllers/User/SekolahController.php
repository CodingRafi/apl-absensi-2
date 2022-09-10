<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

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
            'kepala_sekolah' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'logo' => 'mimes:png,jpg,jpeg|file|max:5024'
        ]);

        $datasekolah = [
            'nama' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'alamat' => $request->alamat,
            'tingkat' => $request->tingkat,
            'kepala_sekolah' => $request->kepala_sekolah,
        ];

        if ($request->youtube) {
            $datasekolah += ['youtube' => $request->youtube];
        }

        if ($request->instagram) {
            $datasekolah += ['instagram' => $request->instagram];
        }

        if ($request->logo) {
            $datasekolah += ['logo' => $request->file('logo')->store('logo')];
        }

        $sekolah = Sekolah::create($datasekolah);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'sekolah_id' => $sekolah->id
        ]);

        $password = $request->password;
        
        $user->assignRole('admin');

        $yayasan = '';
        $password_yayasan = '';
        if($request->name_yayasan && $request->email_yayasan){
            $yayasan = User::create([
                'name' => $request->name_yayasan,
                'email' => $request->email_yayasan,
                'password' => \Hash::make($request->password_yayasan),
                'sekolah_id' => $sekolah->id
            ]);

            $yayasan->assignRole('yayasan');

            $password_yayasan = $request->password_yayasan;
        }

        
        Mail::to($user['email'])->send(new RegisterMail($sekolah, $user, $yayasan, $password, $password_yayasan));

        // $sekolah->notify(new RegisterEmailNotification($sekolah, $request->password));

        return redirect('/login')->with('message', 'Berhasil registrasi');
    }
}
