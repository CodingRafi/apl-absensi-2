<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use App\Http\Requests\StoreRfidRequest;
use App\Http\Requests\UpdateRfidRequest;

class RfidController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_rfid|add_rfid|edit_rfid|delete_rfid', ['only' => ['index','store']]);
         $this->middleware('permission:add_rfid', ['only' => ['create','store']]);
         $this->middleware('permission:edit_rfid', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_rfid', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreRfidRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRfidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function show(Rfid $rfid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function edit(Rfid $rfid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRfidRequest  $request
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRfidRequest $request, Rfid $rfid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rfid  $rfid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rfid $rfid)
    {
        //
    }
}
