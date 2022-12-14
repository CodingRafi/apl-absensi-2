<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Sekolah;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    public function create(){
        $roles = Role::where('name', 'LIKE', '%admin_%')->get();
        return view('myauth.register', compact('roles'));
    }
    
    public function store(Request $request)
    {   
        $request->validate([
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

        $sekolah = Sekolah::store($request);
        $role_admin = Role::where('name_long', 'like', 'Admin ' . $request->ingkat)->first();

        if ($role_admin) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
                'sekolah_id' => $sekolah->id
            ]);

            $user->assignRole($role_admin->name);
    
            if($request->name_yayasan && $request->email_yayasan){
                $yayasan = User::create([
                    'name' => $request->name_yayasan,
                    'email' => $request->email_yayasan,
                    'password' => \Hash::make($request->password_yayasan),
                    'sekolah_id' => $sekolah->id
                ]);
    
                $yayasan->assignRole('yayasan');
            }
            Mail::to($user['email'])->send(new RegisterMail($sekolah, $user, $yayasan, $request->password, $request->password_yayasan));
    
            return redirect('/login')->with('msg_success', 'Berhasil registrasi');
        }else{
            return redirect()->back()->with('msg_error', 'Gagal registrasi');
        }
    }
}
