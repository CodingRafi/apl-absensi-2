<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPelajaran;
use App\Http\Requests\StoreAbsensiPelajaranRequest;
use App\Http\Requests\UpdateAbsensiPelajaranRequest;

class AbsensiPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensipelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbsensiPelajaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbsensiPelajaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiPelajaran $absensiPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiPelajaran $absensiPelajaran)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsensiPelajaran  $absensiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiPelajaran $absensiPelajaran)
    {
        //
    }
}
