<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_kabupaten;
use App\Models\ref_provinsi;
use App\Http\Requests\Storeref_kabupatenRequest;
use App\Http\Requests\Updateref_kabupatenRequest;

class RefKabupatenController extends Controller
{
    public function index(Request $request)
    {   
        return response()->json([
            'data' => ref_provinsi::findOrFail($request->provinsi_id)->ref_kabupaten
        ], 200);
    }
}
