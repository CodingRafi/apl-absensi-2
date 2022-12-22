<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request){ 
        if (\Auth::user()->hasRole('super_admin')) {
            $roles = Role::all();
            $sekolah = Sekolah::all()->count();
            $tahun_ajarans = TahunAjaran::all();

            return view('dashboard', [
                'roles' => $roles,
                'sekolah' => $sekolah,
                'tahun_ajarans' => $tahun_ajarans
            ]);

        }else if(\Auth::user()->hasRole('siswa')){
            return view('dashboard');
        }else {
            $users = [];
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $roles = Role::all();
            
            foreach ($roles as $key => $role) {
                if ($role->name != 'super_admin' && $role->name != 'admin' && $role->name != 'yayasan') {
                    if ($role->name == 'siswa') {
                        $users[$role->name] = User::role($role->name)->join('profile_siswas', 'profile_siswas.user_id', 'users.id')->where('users.sekolah_id', Auth::user()->sekolah_id)->count();
                    }else{
                        $users[$role->name] = User::role($role->name)->where('sekolah_id', Auth::user()->sekolah_id)->count();
                    }
                }
            }

            return view('dashboard', [
                'users' => $users,
                'yayasan' => User::role('yayasan')->where('sekolah_id', Auth::user()->sekolah_id)->first()
            ]);
        }

        

    }
}
