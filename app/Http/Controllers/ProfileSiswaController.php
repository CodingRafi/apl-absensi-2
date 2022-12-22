<?php

namespace App\Http\Controllers;

use App\Models\profile_siswa;
use App\Http\Requests\Storeprofile_siswaRequest;
use App\Http\Requests\Updateprofile_siswaRequest;

class ProfileSiswaController extends Controller
{
    public function store($user, $request)
    {
        dd($request);
    }
}
