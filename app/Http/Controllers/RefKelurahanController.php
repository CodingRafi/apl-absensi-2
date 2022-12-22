<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_kecamatan;
use App\Models\ref_kelurahan;
use App\Http\Requests\Storeref_kelurahanRequest;
use App\Http\Requests\Updateref_kelurahanRequest;

class RefKelurahanController extends Controller
{
    public function index(Request $request)
    {   
        return response()->json([
            'data' => ref_kecamatan::findOrFail($request->kecamatan_id)->ref_kelurahan
        ], 200);
    }
}
