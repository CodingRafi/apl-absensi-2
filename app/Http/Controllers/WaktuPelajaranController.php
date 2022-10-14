<?php

namespace App\Http\Controllers;

use App\Models\WaktuPelajaran;
use App\Http\Requests\StoreWaktuPelajaranRequest;
use App\Http\Requests\UpdateWaktuPelajaranRequest;

class WaktuPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jamPelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jamPelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWaktuPelajaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWaktuPelajaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWaktuPelajaranRequest  $request
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWaktuPelajaranRequest $request, WaktuPelajaran $waktuPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaktuPelajaran  $waktuPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaktuPelajaran $waktuPelajaran)
    {
        //
    }
}
