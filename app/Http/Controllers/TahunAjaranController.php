<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;

class TahunAjaranController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_tahun_ajaran|add_tahun_ajaran|edit_tahun_ajaran|delete_tahun_ajaran', ['only' => ['index','show']]);
         $this->middleware('permission:add_tahun_ajaran', ['only' => ['create','store']]);
         $this->middleware('permission:edit_tahun_ajaran', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_tahun_ajaran', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajarans = TahunAjaran::latest()->get();
        return view('tahun-ajaran.index', [
            'tahun_ajarans' => $tahun_ajarans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun-ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTahunAjaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTahunAjaranRequest $request)
    {
        if($request->status == 'on'){
            foreach (TahunAjaran::all() as $key => $tahunAjaran) {
                $tahunAjaran->update([
                    'status' => 'tidak'
                ]);
            }
        }

        $tahun_ajarans = TahunAjaran::where('status', 'aktif')->count();
        $status;

        if ($tahun_ajarans <= 0) {
            if (!$request->status) {
                $status = 'on';
            }else{
                $status = $request->status;
            }
        }else{
            $status = $request->status;
        }

        TahunAjaran::create([
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'semester' => $request->semester,
            'status' => ($status == 'on') ? 'aktif' : 'tidak',
            'sekolah' => \Auth::user()->sekolah,
        ]);

        return redirect()->route('tahun-ajaran.index')->with('msg_success', 'Berhasil Menambahkan Tahun Ajaran Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.update', [
            'tahun_ajaran' => $tahunAjaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTahunAjaranRequest  $request
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        if($request->status == 'on'){
            foreach (TahunAjaran::all() as $key => $tahun) {
                $tahun->update([
                    'status' => 'tidak'
                ]);
            }
        }
        
        $tahunAjaran->update([
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'semester' => $request->semester,
            'status' => ($request->status && $request->status == 'on') ? 'aktif' : 'tidak',
        ]);
        
        if (!TahunAjaran::where('status', 'aktif')->first()) {
            TahunAjaran::orderBy('created_at', 'desc')->first()->update([
                'status' => 'aktif'
            ]);
        }

        return redirect()->route('tahun-ajaran.index')->with('msg_success', 'Berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response    
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        abort(404);
    }
}
