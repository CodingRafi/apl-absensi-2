<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKelompokRequest;
use App\Http\Requests\UpdateKelompokRequest;

class KelompokController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_kelompok|add_kelompok|edit_kelompok|delete_kelompok', ['only' => ['index','show']]);
         $this->middleware('permission:add_kelompok', ['only' => ['create','store']]);
         $this->middleware('permission:edit_kelompok', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_kelompok', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelompoks = Kelompok::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('kelompok.index', compact('kelompoks'));
    }

    public function create()
    {
        $gurus = User::role('guru')->get();
        return view('kelompok.create', compact('gurus'));
    }

    public function store(StoreKelompokRequest $request)
    {
        $kelompok = Kelompok::create([
            'nama' => $request->nama,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        $kelompok->user()->sync($request->gurus);

        return redirect()->route('kelompok.index')->with('msg_success', 'Berhasil menambah kelompok');
    }

    public function show(){
        abort(404);
    }

    public function edit(Kelompok $kelompok)
    {
        $gurus = User::role('guru')->get();
        return view('kelompok.edit', compact('kelompok', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKelompokRequest  $request
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKelompokRequest $request, Kelompok $kelompok)
    {
        $kelompok->update([
            'nama' => $request->nama,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
        ]);
        
        $kelompok->user()->sync($request->gurus);

        return redirect()->route('kelompok.index')->with('msg_success', 'Berhasil mengupdate kelompok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelompok  $kelompok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelompok $kelompok)
    {
        $kelompok->user()->sync([]);
        $kelompok->delete();
        return redirect()->back()->with('Berhasil menghapus kelompok');
    }
}
