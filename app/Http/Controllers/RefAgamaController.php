<?php

namespace App\Http\Controllers;

use App\Models\ref_agama;
use App\Http\Requests\Storeref_agamaRequest;
use App\Http\Requests\Updateref_agamaRequest;

class RefAgamaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_agama|add_agama|edit_agama|delete_agama', ['only' => ['index','show']]);
         $this->middleware('permission:add_agama', ['only' => ['create','store']]);
         $this->middleware('permission:edit_agama', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_agama', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agamas = ref_agama::all();
        return view('agama.index', compact('agamas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storeref_agamaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeref_agamaRequest $request)
    {
        ref_agama::create([
            'nama' => $request->nama
        ]);

        return redirect()->back()->with('msg_success', 'Berhasil menambahkan agama');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ref_agama  $ref_agama
     * @return \Illuminate\Http\Response
     */
    public function show(ref_agama $ref_agama)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ref_agama  $ref_agama
     * @return \Illuminate\Http\Response
     */
    public function edit(ref_agama $ref_agama, $id)
    {
        $ref_agama = ref_agama::findOrFail($id);
        return view('agama.update', compact('ref_agama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateref_agamaRequest  $request
     * @param  \App\Models\ref_agama  $ref_agama
     * @return \Illuminate\Http\Response
     */
    public function update(Updateref_agamaRequest $request, ref_agama $ref_agama, $id)
    {
        ref_agama::findOrFail($id)->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('agama.index')->with('msg_success', 'Berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ref_agama  $ref_agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(ref_agama $ref_agama)
    {
        abort(404);
    }
}
