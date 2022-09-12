<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Rfid;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\TahunAjaran;
use App\Models\JedaPresensi;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_siswa|add_siswa|edit_siswa|delete_siswa', ['only' => ['index','store']]);
         $this->middleware('permission:add_siswa', ['only' => ['create','store']]);
         $this->middleware('permission:edit_siswa', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_siswa', ['only' => ['destroy']]);
         $this->middleware('permission:import_siswa', ['only' => ['import', 'saveimport']]);
         $this->middleware('permission:export_siswa', ['only' => ['export']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        
        if ($tahun_ajaran) {
            $kelas_filter = Kelas::where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.*', 'kelas.nama as kelas', 'kompetensis.kompetensi as jurusan')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->where('kelas.sekolah_id', \Auth::user()->sekolah_id)->get();
        }else{
            $kelas_filter = [];
            $siswas = [];
        }

        return view('siswa.index',[
            'siswas' => $siswas,
            'kompetensis' => $kompetensis,
            'kelas_filter' => $kelas_filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $jedas = JedaPresensi::where('sekolah_id', \Auth::user()->sekolah->id)->where('siswa', 1)->get();
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('siswa.create',[
            'classes' => $classes,
            'kompetensis' => $kompetensis,
            'jedas' => $jedas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiswaRequest $request)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $data = [
            'name' => $request->name,
            'nisn' => $request->nisn,
            'nipd' => $request->nipd,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'sekolah_id' => \Auth::user()->sekolah_id,
            'jeda_presensi_id' => $request->jeda_presensi_id
        ];

        if (\Auth::user()->sekolah->tingkat == 'smk') {
            $data += ['kompetensi_id' => $request->kompetensi_id];
        }

        if($request->file('profil')){
            $data += [
                'profil' => $request->file('profil')->store('profil_siswa')
            ];
        }

        $siswa = Siswa::create($data);
        
        if ($request->rfid) {
            Rfid::createRfid($request->rfid, $siswa->id, null, $request->status_rfid);
        }

        return TahunAjaran::redirectTahunAjaran('/siswa', $request, 'Berhasil menambahkan siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        if ($siswa->sekolah_id == \Auth::user()->sekolah->id) {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $jedas = JedaPresensi::where('sekolah_id', \Auth::user()->sekolah->id)->where('siswa', 1)->get();
            $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
            $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
    
            return view('siswa.update', [
                'classes' => $classes,
                'kompetensis' => $kompetensis,
                'siswa' => $siswa,
                'jedas' => $jedas
            ]);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        if ($siswa->sekolah_id == \Auth::user()->sekolah_id) {
            $data = [
                'name' => $request->name,
                'nisn' => $request->nisn,
                'nipd' => $request->nipd,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'jk' => $request->jk,
                'kelas_id' => $request->kelas_id,
                'jalan' => $request->jalan,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'jeda_presensi_id' => $request->jeda_presensi_id
            ];
            if (\Auth::user()->sekolah->tingkat == 'smk') {
                $data += ['kompetensi_id' => $request->kompetensi_id];
            }

            if ($request->file('profil')) {
                if($siswa->profil != '/img/profil'){
                    Storage::delete($siswa->profil);
                }
                $data += [
                    'profil' => $request->file('profil')->store('profil_siswa')
                ];
            }

            $siswa->update($data);

            if ($siswa->rfid) {
                if($request->id_rfid){
                    Rfid::updateRfid($request);
                }
            }else{
                Rfid::create([
                    'rfid_number' => $request->rfid,
                    'siswa_id' => $siswa->id,
                    'status' => ($request->status_rfid == 'on') ? 'aktif' : 'tidak'
                ]);
            }
    
            return TahunAjaran::redirectTahunAjaran('/siswa', $request, 'Berhasil Mengupdate Siswa');
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = Siswa::deleteSiswa($id);
        return TahunAjaran::redirectTahunAjaran('/siswa', $request, 'Berhasil Menghapus Siswa');
    }

    public function import(Request $request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $classes = Kelas::where('sekolah_id', \Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
        $kompetensis = Kompetensi::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $jedas = JedaPresensi::where('sekolah_id', \Auth::user()->sekolah->id)->where('siswa', 1)->get();

        return view('import', [
            'classes' => $classes,
            'kompetensis' => $kompetensis,
            'jedas' => $jedas
        ]);
    }

    public function saveimport(Request $request){
        $siswas = (new FastExcel)->import($request->file);

        foreach ($siswas as $key => $siswa) {
            if (array_key_exists("nisn",$siswa) && array_key_exists("nipd",$siswa) && array_key_exists("nik",$siswa)) {
                if ($siswa['name'] != null && $siswa['nisn'] != null && $siswa['nipd'] != null) {
                    $data = [
                        'name' => $siswa['name'],
                        'nisn' => $siswa['nisn'],
                        'nipd' => $siswa['nipd'],
                        'jk' => ($siswa['jk'] == 'L' || $siswa['jk'] == 'P') ? strtoupper($siswa['jk']) : null,
                        'tempat_lahir' => $siswa['tempat_lahir'],
                        'tanggal_lahir' => Siswa::filterDate($siswa['tanggal_lahir']),
                        'nik' => $siswa['nik'],
                        'agama' => $siswa['agama'],
                        'jalan' => $siswa['jalan'],
                        'kelurahan' => $siswa['kelurahan'],
                        'kecamatan' => $siswa['kecamatan'],
                        'jeda_presensi_id' => $request->jeda_presensi_id,
                        'sekolah_id' => \Auth::user()->sekolah_id,
                        'kelas_id' => $request->kelas_id,
                    ];

                    if (\Auth::user()->sekolah->tingkat == 'smk') {
                        $data += ['kompetensi_id' => $request->kompetensi_id];
                    }

                    $siswa = Siswa::create($data);

                    if($siswa['rfid']){
                        Rfid::createRfid($siswa['rfid'], $siswa->id, null, ($siswa['status_rfid']) ? $siswa['status_rfid'] : '');
                    }
                }
            }else{
                return TahunAjaran::redirectTahunAjaran('/import', $request, 'kolom tidak valid');
            }
        }

        return TahunAjaran::redirectTahunAjaran('/siswa', $request, 'Berhasil menginport siswa');
    }

    public function export(Request $request){
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        if (\Auth::user()->sekolah->tingkat == 'smk') {
            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.name', 'siswas.nisn', 'siswas.nipd', 'kelas.nama as Kelas', 'kompetensis.kompetensi as Jurusan', 'siswas.jk', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.nik', 'siswas.agama', 'siswas.jalan', 'siswas.kelurahan', 'siswas.kecamatan', 'rfids.rfid_number', 'rfids.status as status_rfid', 'jeda_presensis.nama as sesi')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->leftJoin('rfids', 'rfids.siswa_id', 'siswas.id')->leftJoin('jeda_presensis', 'jeda_presensis.id', 'siswas.jeda_presensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();
        }else{
            $siswas = Siswa::filter(request(['idk', 'idj', 'search']))->select('siswas.name', 'siswas.nisn', 'siswas.nipd', 'kelas.nama as Kelas', 'siswas.jk', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.nik', 'siswas.agama', 'siswas.jalan', 'siswas.kelurahan', 'siswas.kecamatan', 'rfids.rfid_number', 'rfids.status as status_rfid','jeda_presensis.nama as sesi')->leftJoin('kelas', 'kelas.id', 'siswas.kelas_id')->leftJoin('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')->leftJoin('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->leftJoin('rfids', 'rfids.siswa_id', 'siswas.id')->leftJoin('jeda_presensis', 'jeda_presensis.id', 'siswas.jeda_presensi_id')->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get();
        }

        return (new FastExcel($siswas))->download('file.xlsx');
    }
}
