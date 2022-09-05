<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){ 
        $sekolah = \Auth::user()->sekolah;

        if ($sekolah) {
            $roles = Role::all();
            $users_query = \Auth::user()->sekolah->user;
            $users = [];
            
            foreach ($roles as $key => $role) {
                if ($role->name != 'super_admin' && $role->name != 'admin' && $role->name != 'yayasan') {
                    foreach ($users_query as $key => $user) {
                        $users[$role->name] = User::whereHas("roles", function($q) use ($role) { $q->where("name", $role->name); })->get();
                    }
                }
            }
        
            return view('dashboard', [
                'users' => $users
            ]);
        }else{
            return view('dashboard');
        }
    }
}
