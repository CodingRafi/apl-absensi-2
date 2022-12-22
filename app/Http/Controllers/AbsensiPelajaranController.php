<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPelajaran;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreAbsensiPelajaranRequest;
use App\Http\Requests\UpdateAbsensiPelajaranRequest;
use Illuminate\Http\Request;

class AbsensiPelajaranController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:view_absensi_pelajaran|add_absensi_pelajaran|edit_absensi_pelajaran|delete_absensi_pelajaran', ['only' => ['index','store']]);
         $this->middleware('permission:add_absensi_pelajaran', ['only' => ['create','store']]);
         $this->middleware('permission:edit_absensi_pelajaran', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_absensi_pelajaran', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        return view('absensipelajaran.index', [
            'absensi_pelajarans' => \Auth::user()->absensi_pelajaran->where('tahun_ajaran_id', $tahun_ajaran->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbsensiPelajaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbsensiPelajaranRequest $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiPelajaranRequest  $request
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbsensiPelajaranRequest $request, AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiPelajaran $absensiPelajaran)
    {
        abort(404);
    }
}
