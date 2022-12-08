<?php

namespace App\Http\Controllers;

use App\Models\StatusKehadiran;
use App\Http\Requests\StoreStatusKehadiranRequest;
use App\Http\Requests\UpdateStatusKehadiranRequest;

class StatusKehadiranController extends Controller
{
    public function __construct()
    {
    $this->middleware('permission:view_status_kehadiran|edit_status_kehadiran|delete_status_kehadiran', ['only' => ['index', 'store']]);
    $this->middleware('permission:add_status_kehadiran', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_status_kehadiran', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete_status_kehadiran', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('status_kehadiran.index');
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
     * @param  \App\Http\Requests\StoreStatusKehadiranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusKehadiranRequest $request)
    {
        StatusKehadiran::create([
            'nama' => $request->nama,
            'color' => $request->color
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusKehadiran  $statusKehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(StatusKehadiran $statusKehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusKehadiran  $statusKehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusKehadiran $statusKehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusKehadiranRequest  $request
     * @param  \App\Models\StatusKehadiran  $statusKehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusKehadiranRequest $request, StatusKehadiran $statusKehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusKehadiran  $statusKehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusKehadiran $statusKehadiran)
    {
        //
    }
}
