<?php

namespace App\Http\Controllers;

use Auth, DB;
use Carbon\Carbon;
use App\Models\Rfid;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Absensi;
use App\Models\Kompetensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use App\Models\StatusKehadiran;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;

class AbsensiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_absensi|add_absensi|edit_absensi|delete_absensi', ['only' => ['index','show']]);
         $this->middleware('permission:add_absensi', ['only' => ['create','store']]);
         $this->middleware('permission:edit_absensi', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_absensi', ['only' => ['destroy']]);
         $this->middleware('permission:export_absensi', ['only' => ['export']]);
         $this->middleware('permission:show_absensi', ['only' => ['show_absensi_user']]);
    }

    private function get_absensi(Request $request, $role, $tahun_ajaran, $date, $id = null){
        $users = User::getUser($request, $role);

        $absensis = [];

        foreach ($users as $key => $user) {
            $absensis[] = Absensi::get_absensi($user, $date, $role, $tahun_ajaran);
        }

        return $absensis;
    }

    public function index(Request $request, $role)
    {
        $date = $this->getDate();
        $status_kehadiran = StatusKehadiran::all();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            
        $return = [
            'role' => $role,
            'date' => $date,
            'status_kehadiran' => $status_kehadiran,
        ];
        
        if ($role == 'siswa') {
            if (check_jenjang()) {
                $return += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $return += ['kelas' => Kelas::getKelas($request)];
        }

        $absensis = $this->get_absensi($request, $role, $tahun_ajaran, $date);

        $return += ['absensis' => $absensis];

        return view('absensi.index', $return);
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

    public function store_update(Request $request){
        if ($request->presensi == 'masuk') {
            $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();
            if(!$absensi){
                $tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
                Absensi::create([
                    'user_id' => $request->user_id,
                    'status_kehadiran_id' => $request->status_kahadiran_id,
                    'presensi_masuk' => (($request->waktu) ? ($request->date . ' ' . $request->waktu .  ':00') : ($request->date . ' ' . explode(' ', Carbon::now())[1])),
                    'tahun_ajaran_id' => $tahun_ajaran->id
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
        }else{
            $absensi = Absensi::where('user_id', $request->user_id)->whereDate('presensi_masuk', $request->date)->first();
            if($absensi){
                if($request->kehadiran == $absensi->kehadiran){
                    $absensi->update([
                        'presensi_pulang' => ($request->waktu) ? $request->date . ' ' . date('H:i', strtotime($request->waktu)) .  ':00' : $request->date . ' ' . explode(' ', Carbon::now())[1]
                    ]);
                }else{
                    return redirect()->back()->with('msg_error', 'Kehadiran tidak sesuai dengan presensi masuk');
                }
            }else{
                return redirect()->back()->with('msg_error', 'Belum presensi masuk');
            }
        }

        return redirect()->back()->with('msg_success', 'Berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        $absensi = Absensi::findOrFail($id);
        return response()->json([
            'data' => $absensi
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbsensiRequest  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        abort(404);
    }

    public function export(Request $request, $role){
        $date = $this->getDate();
        $status_kehadiran = StatusKehadiran::all();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $absensis = $this->get_absensi($request, $role, $tahun_ajaran, $date);

        return Excel::download(new AbsensiExport($role, $absensis, $date, $status_kehadiran), 'absensi.xlsx');
    }

    public function show_absensi_user(Request $request){
        $date = $this->getDate();
        $role = Auth::user()->getRoleNames()[0];
        $status_kehadiran = StatusKehadiran::all();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            
        $return = [
            'date' => $date,
            'status_kehadiran' => $status_kehadiran,
        ];

        $absensis = $this->get_absensi($request, $role, $tahun_ajaran, $date, Auth::user()->id);
        
        $return += ['absensis' => $absensis];

        return view('absensi.show', $return);
    }
}
