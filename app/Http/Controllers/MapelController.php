<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_mapel|add_mapel|edit_mapel|delete_mapel', ['only' => ['index','store']]);
         $this->middleware('permission:add_mapel', ['only' => ['create','store']]);
         $this->middleware('permission:edit_mapel', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_mapel', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('mapel.index', [
            'mapels' => $mapels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMapelRequest $request)
    {
        Mapel::create([
            'nama' => $request->nama,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectWithTahunAjaran('mapel.index', $request,  'Berhasil menambahkan mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        if ($mapel->sekolah_id == \Auth::user()->sekolah->id) {
            return view('mapel.update', [
                'data' => $mapel
            ]);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMapelRequest  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        if ($mapel->sekolah_id == \Auth::user()->sekolah->id) {
            $mapel->update([
                'nama' => $request->nama
            ]);
            
            return TahunAjaran::redirectWithTahunAjaran('mapel.index', $request,  'Berhasil mengupdate mapel');
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        if ($mapel->sekolah_id == \Auth::user()->sekolah->id) {
            foreach ($mapel->user as $key => $guru) {
                $guru->mapel()->detach($id);
            }
    
            foreach ($mapel->agenda as $key => $agenda) {
                $agenda->delete();
            }
    
            $mapel->delete();
    
            return TahunAjaran::redirectWithTahunAjaran('mapel.index', $request, 'Mapel Berhasil Dihapus');
        }else{
            abort(403);
        }
    }
}
