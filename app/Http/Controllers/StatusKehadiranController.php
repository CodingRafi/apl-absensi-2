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
        $status_kehadirans = StatusKehadiran::all();
        return view('status_kehadiran.index', compact('status_kehadirans'));
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

        return redirect()->back()->with('msg_success', 'Berhasil Menambahkan Status Kehadiran');
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
        return view('status_kehadiran.update', compact('statusKehadiran'));
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
        $statusKehadiran->update([
            'nama' => $request->nama,
            'color' => $request->color,
        ]);

        return redirect()->route('status-kehadiran.index')->with('msg_success', 'Berhasil Mengubah Status Kehadiran');
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
