<?php

namespace App\Http\Controllers\User;

use DB, Auth;
use App\Models\User;
use App\Models\Sekolah;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\StoreSekolahRegRequest;

class SekolahController extends Controller
{
    public function __construct(){
        $count_tahun_ajaran = DB::table('tahun_ajarans')->count();
        if ($count_tahun_ajaran < 1) {
            abort(404);
        }
    }

    public function create(){
        $provinsis = DB::table('ref_provinsis')->get();
        $tingkats = DB::table('ref_tingkats')->get();
        return view('myauth.register', compact('provinsis', 'tingkats'));
    }
    
    public function store(StoreSekolahRegRequest $request)
    {   
        $sekolah = Sekolah::create([
            'nama' => $request->nama_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'npsn' => $request->npsn,
            'ref_provinsi_id' => $request->ref_provinsi_id,
            'ref_kabupaten_id' => $request->ref_kabupaten_id,
            'ref_kecamatan_id' => $request->ref_kecamatan_id,
            'ref_kelurahan_id' => $request->ref_kelurahan_id,
            'jalan' => $request->jalan,
            'jenjang' => $request->jenjang,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]);

        $sekolah->tingkat()->sync($request->tingkat_id);

        $user = User::create([
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'sekolah_id' => $sekolah->id
        ]);

        $user->assignRole('admin');

        DB::table('profile_users')->insert([
            'name' => $request->name,
            'user_id' => $user->id
        ]);

        if($request->name_yayasan && $request->email_yayasan){
            $yayasan = User::create([
                'email' => $request->email_yayasan,
                'password' => \Hash::make($request->password_yayasan),
                'sekolah_id' => $sekolah->id
            ]);

            $yayasan->assignRole('yayasan');

            
            DB::table('profile_users')->insert([
                'name' => $request->name_yayasan,
                'user_id' => $yayasan->id
            ]);
        }

        Mail::to($user->email)->send(new RegisterMail($user, $yayasan ?? '', $request->password, $request->password_yayasan));

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME)->with('msg_success', "Berhasil Login"); 
    }

    public function edit(){
        $provinsis = DB::table('ref_provinsis')->get();
        $data = Auth::user()->sekolah;
        // $tingkats = DB::table('ref_tingkats')->get();
        // $data['tingkat'] = $this->parseDataToArray($data->tingkat);
        return view('sekolah.edit', compact('provinsis', 'data'));
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'nama' => 'required',
            'npsn' => 'required',
            'ref_provinsi_id' => 'required',
            'ref_kabupaten_id' => 'required',
            'ref_kecamatan_id' => 'required',
            'ref_kelurahan_id' => 'required',
            'jalan' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|file|max:5024',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'kepala_sekolah' => 'nullable',
        ]);

        $sekolah = Auth::user()->sekolah;

        if ($request->logo) {
            if ($sekolah->logo != '/img/tutwuri.png	') {
                Storage::delete($sekolah->logo);
            }
            $validatedData += ['logo' => $request->file('logo')->store('logo')];
        }

        $sekolah->update($validatedData);

        return redirect()->route('dashboard')->with('msg_success', 'Data Sekolah Berhasil Terupdate');
    }
}
