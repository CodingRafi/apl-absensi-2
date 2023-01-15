<?php

namespace App\Http\Controllers;

use DB, Auth;
use App\Models\User;
use App\Models\Kelompok;
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
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        $kelompok->user()->sync($request->gurus);

        return redirect()->route('kelompok.index')->with('msg_success', 'Berhasil menambah kelompok');
    }

    public function show(Kelompok $kelompok){
        if ($kelompok->sekolah_id != Auth::user()->sekolah_id) {
            abort(403);
        }

        $agendas = [];

        foreach (config('services.hari.value') as $hari) {
            $agenda = DB::table('kelompok_jadwals')->select('jam_masuk', 'jam_pulang', 'id')->where('hari', $hari)->first();
            $agendas[] = [
                "hari" => $hari,
                'jam_masuk' => $agenda ? $agenda->jam_masuk : '',
                'jam_pulang' => $agenda ? $agenda->jam_pulang : '',
                'id' => $agenda ? $agenda->id : ''
            ];
        }

        return view('kelompok.show', compact('kelompok', 'agendas'));
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
        $kelompok->kelompok_jadwal()->delete();
        $kelompok->delete();
        return redirect()->back()->with('msg_success', 'Berhasil menghapus kelompok');
    }
}
