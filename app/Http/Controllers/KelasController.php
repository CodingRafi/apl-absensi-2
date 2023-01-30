<?php

namespace App\Http\Controllers;

use DB, Auth;
use App\Models\Kelas;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KelasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_kelas|add_kelas|edit_kelas|delete_kelas', ['only' => ['index','show']]);
         $this->middleware('permission:add_kelas', ['only' => ['create','store']]);
         $this->middleware('permission:edit_kelas', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_kelas', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('kelas.index');
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(StoreKelasRequest $request)
    {   
        Kelas::create([
            'ref_tingkat_id' => $request->tingkat_id,
            'nama' => $request->nama,
            'sekolah_id' => \Auth::user()->sekolah_id
        ]);

        return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Ditambahkan');
    }

    public function show(Kelas $kelas)
    {
        abort(404);
    }

    public function edit(Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            return view('kelas.update', [
                'data' => $kelas
            ]);
        }

        abort(403);
    }

    public function update(UpdateKelasRequest $request, Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            $kelas->update([
                'ref_tingkat_id' => $request->tingkat_id,
                'nama' => $request->nama
            ]);
    
            return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Diupdate');
        }

        abort(403);
    }

    public function destroy(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        if ($kelas->sekolah_id == \Auth::user()->sekolah->id) {
            foreach ($kelas->users as $key => $siswa) {
                User::deleteUser('siswa', $siswa->id);
            }
    
            foreach ($kelas->agenda as $key => $agenda) {
                $agenda->delete();
            }
    
            $kelas->delete();
    
            return TahunAjaran::redirectWithTahunAjaran('kelas.index', $request, 'Kelas Berhasil Dihapus');
        }

        abort(403);
    }

    public function get_data(Request $request){
        $tahun_ajarans = TahunAjaran::latest()->get();
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        $kelas =  DB::table('kelas')
                    ->select('kelas.*', 'ref_tingkats.romawi')
                    ->join('ref_tingkats', 'ref_tingkats.id', 'kelas.ref_tingkat_id')
                    ->join('user_kelas', 'user_kelas.kelas_id', 'kelas.id')
                    ->where('user_kelas.tahun_ajaran_id', $tahun_ajaran->id)
                    ->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                    ->distinct('user_kelas.kelas_id')
                    ->get();
        $to_kelas = Kelas::getKelas($request);
        return response()->json([
            'tahun_ajarans' => $tahun_ajarans,
            'kelas' => $kelas,
            'to_kelas' => $to_kelas
        ], 200);
    }

    public function upgrade(Request $request){
        $request->validate([
            'tahun_ajaran_id' => 'required',
            'kelas_id' => 'required',
            'to_kelas_id' => 'required'
        ]);

        if ($request->kelas_id == $request->to_kelas_id) {
            throw ValidationException::withMessages(['msg_error' => 'Tidak ada kenaikan kelas']);
        } else {
            $kelas = Kelas::where('id', $request->kelas_id)->first();
            $to_kelas = Kelas::where('id', $request->to_kelas_id)->first();

            if ($kelas->tingkat->key > $to_kelas->tingkat->key) {
                return throw ValidationException::withMessages(['msg_error' => 'Maaf tidak bisa mundur kelas']);
            } else {
                $tahun_ajaran_old = DB::table('user_kelas')
                                    ->select('tahun_ajarans.*')
                                    ->join('tahun_ajarans', 'tahun_ajarans.id', 'user_kelas.tahun_ajaran_id')
                                    ->where('user_kelas.kelas_id', $request->kelas_id)
                                    ->distinct('user_kelas.kelas_id')
                                    ->first();

                                    
                $tahun_ajaran_new = DB::table('tahun_ajarans')->where('id', $request->tahun_ajaran_id)->first();

                if ($tahun_ajaran_old->tahun_awal >= $tahun_ajaran_new->tahun_awal && $tahun_ajaran_old->tahun_akhir >= $tahun_ajaran_new->tahun_akhir && $tahun_ajaran_old->semester == $tahun_ajaran_new->semester) {
                    return throw ValidationException::withMessages(['msg_error' => 'tidak bisa naik kelas tahun ajaran turun/tidak naik']);
                }else{
                    foreach ($kelas->users as $key => $user) {
                        DB::table('user_kelas')->insert([
                            'user_id' => $user->id,
                            'kelas_id' => $request->to_kelas_id,
                            'tahun_ajaran_id' => $request->tahun_ajaran_id
                        ]);
                    }

                    return redirect()->back()->with('msg_success', 'Berhasil diupgrade');
                }
            }
            
        }
        
    }
}
