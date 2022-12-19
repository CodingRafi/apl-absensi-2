<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function check_user($id, $role){
        if ($role != 'siswa') {
            $data = User::findOrFail($id);
            if (!$data->hasRole($role)) {
                return abort(403);
            }
        }else{
            $data = Siswa::findOrFail($id);
        }

        if ($data->sekolah->id != \Auth::user()->sekolah->id) {
            return abort(403);
        }
    }
}
