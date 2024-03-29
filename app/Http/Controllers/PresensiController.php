<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\TahunAjaran;
use App\Models\Kompetensi;
use App\Models\Absensi;
use Carbon\Carbon;
use App\Exports\PresensiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_presensi|add_presensi|edit_presensi|delete_presensi', ['only' => ['index','show']]);
         $this->middleware('permission:add_presensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_presensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_presensi', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        abort(404);
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
     * @param  \App\Http\Requests\StorePresensiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_update(Request $request)
    {
        $absensi = Presensi::where('user_id', $request->user_id)
                            ->where('absensi_pelajaran_id', $request->absensi_pelajaran_id)
                            ->whereDate('presensi_masuk', $request->date)->first();
        if(!$absensi){
            Presensi::create([
                'user_id' => $request->user_id,
                'absensi_pelajaran_id' => $request->absensi_pelajaran_id,
                'status_kehadiran_id' => $request->status_kahadiran_id,
                'presensi_masuk' => (($request->waktu) ? ($request->date . ' ' . $request->waktu .  ':00') : ($request->date . ' ' . explode(' ', Carbon::now())[1])),
            ]);
        }else{
            $update = ['status_kehadiran_id' => $request->status_kahadiran_id];
            
            if ($request->presensi == 'masuk') {
                $update += ['presensi_masuk' => $request->date . ' ' . $request->waktu];
            } else {
                $update += ['presensi_pulang' => $request->date . ' ' . $request->waktu];
            }

            $absensi->update($update);
        }

        return redirect()->back()->with('msg_success', 'Berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absensi = Presensi::findOrFail($id);
        return response()->json([
            'data' => $absensi
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Presensi $presensi)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresensiRequest  $request
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresensiRequest $request, Presensi $presensi, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $presensi->update([
            'kehadiran' => $request->kehadiran
        ]);

        return redirect()->back()->with('msg_success', 'Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        abort(404);
    }

    public function export(Request $request){
        $now = Carbon::now();
        $month = request('idb') ?? $now->month;
        $year = $now->year;
        $date=[];
        
        for($d=0; $d<=32; $d++)
        {
            $time=mktime(24, 0, 0, $month, $d, $year);  
            if (date('m', $time)==$month)       
            $date[]=date('Y-m-d', $time);
        }

        $presensis = [];

        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();

        foreach ($siswas as $key => $siswa) {
            $presensis[] = Presensi::get_presensi($siswa, $date);
        }

        return Excel::download(new PresensiExport($presensis, $siswas, $date), 'presensi.xlsx');

        return view('absensipelajaran.export', [
            'date' => $date,
            'presensis' => $presensis,
            'siswas' => $siswas,
        ]);
    }
}
