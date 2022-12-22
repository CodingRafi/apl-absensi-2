<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ref_kabupaten;
use App\Models\ref_kecamatan;
use App\Http\Requests\Storeref_kecamatanRequest;
use App\Http\Requests\Updateref_kecamatanRequest;

class RefKecamatanController extends Controller
{
    public function index(Request $request)
    {   
        return response()->json([
        'data' => ref_kabupaten::findOrFail($request->kabupaten_id)->ref_kecamatan
        ], 200);
    }
}
