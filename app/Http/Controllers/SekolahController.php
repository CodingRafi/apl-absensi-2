<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Http\Requests\StoreSekolahRequest;
use App\Http\Requests\UpdateSekolahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_sekolah|add_sekolah|edit_sekolah|delete_sekolah', ['only' => ['index','store']]);
         $this->middleware('permission:add_sekolah', ['only' => ['create','store']]);
         $this->middleware('permission:edit_sekolah', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_sekolah', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Sekolah::all();

        return view('sekolah.index', [
            'schools' => $schools
        ]);
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
     * @param  \App\Http\Requests\StoreSekolahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        return view('sekolah.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSekolahRequest  $request
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSekolahRequest $request, Sekolah $sekolah)
    {
        $data =[
            'nama' => $request->nama,
            'npsn' => $request->npsn,
            'kepala_sekolah' => $request->kepala_sekolah,
            'alamat' => $request->alamat,
        ];

        if ($request->instagram) {
            $data += ['instagram' => $request->instagram];
        }
        
        if ($request->youtube) {
            $data += ['youtube' => $request->youtube];
        }

        if ($request->logo) {
            if ($sekolah->logo != '/img/tutwuri.png	') {
                Storage::delete($sekolah->logo);
            }
            $data += ['logo' => $request->file('logo')->store('logo')];
        }

        $sekolah->update($data);

        return redirect('/')->with('message', 'Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        dd($sekolah);
    }
}
