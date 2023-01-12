<?php

namespace App\Http\Controllers;

use DB, Hash, Auth;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Rfid;
use App\Models\ref_agama;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_users', ['only' => ['index','show']]);
         $this->middleware('permission:add_users', ['only' => ['create','store']]);
         $this->middleware('permission:edit_users', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_users', ['only' => ['destroy']]);
         $this->middleware('permission:import_users', ['only' => ['import', 'saveimport']]);
         $this->middleware('permission:export_users', ['only' => ['export']]);
    }
    
    public function index(Request $request, $role)
    {   
        $users = User::select('users.*')
                    ->when($role == 'siswa', function($q) use($role, $request){
                        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
                        $q->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                            // ->join('user_kelas', 'user_kelas.user_id', 'users.id')
                            // ->join('kelas', 'user_kelas.kelas_id', 'kelas.id')
                            ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                            ->join('tahun_ajarans', 'tahun_ajarans.id', 'profile_siswas.tahun_ajaran_id')
                            ->where('profile_siswas.tahun_ajaran_id', $tahun_ajaran->id)
                            ->filterSiswa(request(['kelas', 'jurusan', 'search']));
                    })
                    ->when($role != 'siswa', function($q) use($role){
                        $q->join('profile_users', 'profile_users.user_id', 'users.id')
                            ->filterUser(request(['search']));
                    })
                    ->role($role) 
                    ->where('users.sekolah_id', \Auth::user()->sekolah_id)
                    ->get();
        $data = [
            'users' => $users,
            'role' => $role
        ];

        $users = User::role('siswa');
        

        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma') {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => DB::table('kelas')->where('sekolah_id', Auth::user()->sekolah_id)->where('tahun_ajaran_id', $tahun_ajaran->id)->get()];
        }

        return view('users.index', $data);
    }

    public function create(Request $request, $role)
    {   
        $provinsis = DB::table('ref_provinsis')->get();
        $agamas = ref_agama::all();
        $data = [
            'provinsis' => $provinsis,
            'agamas' => $agamas,
            'role' => $role,
        ];
        
        if ($role == 'guru') {
            $data += ['mapels' => DB::table('mapels')->where('sekolah_id', \Auth::user()->sekolah_id)->get()];
        }
        
        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma') {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => DB::table('kelas')->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                                                    ->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get()];
        }

        return view('users.create', $data);
    }

    public function store(StoreUserRequest $request, $role)
    {   
        $data = [
            'profil' => isset($data['profil']) ? $data['profil'] : '/img/profil.png',
            'sekolah_id' => Auth::user()->sekolah_id,
            'email' => $request->email
        ];
        if ($role == 'siswa') {
            $request->validate([
                'nipd' => 'required|unique:users',
                'nisn' => 'required|unique:profile_siswas'
            ]);
            $data += ['nipd' => $request->nipd];
        }else{
            $request->validate([
                'nip' => 'required|unique:users'
            ]);
            $data += ['nip' => $request->nip];
        }
        
        $user = User::create($data);
        $user->assignRole($role);

        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $user->kelas()->syncWithPivotValues([$request->kelas_id], ['tahun_ajaran_id' => $tahun_ajaran->id]);
            app('App\Http\Controllers\ProfileSiswaController')->store($user, $request);
        }else{
            app('App\Http\Controllers\ProfileUserController')->store($user, $request, $role);
        }

        if ($request->rfid_number) {
            Rfid::create([
                'rfid_number' => $number_rfid,
                'user_id' => $user->id,
                'status' => ($status == 'on') ? 'aktif' : 'tidak'
            ]);
        }

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$role]), $request,  'Berhasil menambahkan ' . $role);
    }

    
    public function show($role, $id){
        $this->check_user($id, $role);
        $user = User::when($role == 'siswa', function ($q) use($role) {
                            return $q->select('users.email', 'users.profil', 'users.nipd', 'profile_siswas.nisn', 'profile_siswas.nik','profile_siswas.jk', 'profile_siswas.jalan', 'profile_siswas.name', 'profile_siswas.tempat_lahir', 'profile_siswas.tanggal_lahir', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama', 'kelas.nama as kelas', 'kompetensis.kompetensi')
                                    ->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                                    ->join('user_kelas', 'user_kelas.user_id', 'users.id')
                                    ->join('kelas', 'user_kelas.kelas_id', 'kelas.id')
                                    ->join('kompetensis', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                                    ->join('ref_agamas', 'profile_siswas.ref_agama_id', 'ref_agamas.id')
                                    ->join('ref_provinsis', 'profile_siswas.ref_provinsi_id', 'ref_provinsis.id')
                                    ->join('ref_kabupatens', 'profile_siswas.ref_kabupaten_id', 'ref_kabupatens.id')
                                    ->join('ref_kecamatans', 'profile_siswas.ref_kecamatan_id', 'ref_kecamatans.id')
                                    ->join('ref_kelurahans', 'profile_siswas.ref_kelurahan_id', 'ref_kelurahans.id');
                        })->when($role != 'siswa', function($q) use($role){
                            return $q->select('users.email', 'users.profil', 'users.nip', 'profile_users.*','profile_users.jk', 'profile_users.tempat_lahir', 'profile_users.tanggal_lahir', 'profile_users.jalan', 'profile_users.name', 'ref_provinsis.nama as provinsi', 'ref_kabupatens.nama as kabupaten', 'ref_kecamatans.nama as kecamatan', 'ref_kelurahans.nama as kelurahan', 'ref_agamas.nama as agama')
                                    ->join('profile_users', 'profile_users.user_id', 'users.id')
                                    ->join('ref_agamas', 'profile_users.ref_agama_id', 'ref_agamas.id')
                                    ->join('ref_provinsis', 'profile_users.ref_provinsi_id', 'ref_provinsis.id')
                                    ->join('ref_kabupatens', 'profile_users.ref_kabupaten_id', 'ref_kabupatens.id')
                                    ->join('ref_kecamatans', 'profile_users.ref_kecamatan_id', 'ref_kecamatans.id')
                                    ->join('ref_kelurahans', 'profile_users.ref_kelurahan_id', 'ref_kelurahans.id');
                        })->where('users.id', $id)->first();
        // dd($user);
        return view('users.show', compact('user', 'role'));
    }

    public function edit(Request $request, $role, $id)
    {   
        $this->check_user($id, $role);
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        
        $user = User::when($role == 'siswa', function ($q) use($role, $tahun_ajaran) {
                    return $q->select('users.*', 'profile_siswas.*', 'users.id as id')
                                ->join('profile_siswas', 'profile_siswas.user_id', 'users.id');
                })->when($role != 'siswa', function($q) use($role){
                    return $q->select('users.*', 'profile_users.*', 'users.id as id')
                            ->join('profile_users', 'profile_users.user_id', 'users.id');
                })->where('users.id', $id)->first();

        if ($role == 'siswa') {
            $kelas = $user->kelas()->where('user_kelas.tahun_ajaran_id', $tahun_ajaran->id)->first();
            $user['kelas_id'] = ($kelas) ? $kelas->id : '';
        }

        $provinsis = DB::table('ref_provinsis')->get();
        $agamas = ref_agama::all();
        $data = [
            'provinsis' => $provinsis,
            'agamas' => $agamas,
            'role' => $role,
            'data' => $user
        ];
        
        if ($role == 'guru') {
            $data += ['mapels' => DB::table('mapels')->where('sekolah_id', \Auth::user()->sekolah_id)->get()];
        }
        
        if ($role == 'siswa') {
            if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma') {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => DB::table('kelas')->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                                                    ->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get()];
        }
        return view('users.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $role, $id)
    {
        $user = User::findOrFail($id);
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);

        if ($request->rfid_number) {
            $rfid = $user->rfid;
            if ($rfid) {
                $request->validate([
                    'rfid_number' => [Rule::unique('rfids')->ignore($rfid->id)],
                ]);

                $rfid->update([
                    'rfid_number' => $request->rfid_number,
                    'status' => ($request->status_rfid   == 'on') ? 'aktif' : 'tidak'
                ]);
            }else{
                Rfid::create([
                    'rfid_number' => $request->rfid_number,
                    'user_id' => $user->id,
                    'status' => ($request->status_rfid == 'on') ? 'aktif' : 'tidak'
                ]);
            }
        }

        $data = [
            'sekolah_id' => Auth::user()->sekolah_id,
            'email' => $request->email
        ];
        
        if ($role == 'siswa') {
            $request->validate([
                'nipd' => ['required', Rule::unique('users')->ignore($user->id)], 
                'nisn' => ['required', Rule::unique('profile_siswas')->ignore($user->profile_siswa->id)], 
            ]);
            $data += ['nipd' => $request->nipd];
        }else{
            $request->validate([
                'nip' => ['required', Rule::unique('users')->ignore($user->id)], 
            ]);
            $data += ['nip' => $request->nip];
        }
        
        if ($request->file('profil')) {
            if($user->profil != '/img/profil.png'){
                Storage::delete($user->profil);
            }
            $data['profil'] = $request->file('profil')->store('profil');
        }
        
        $user->update($data);

        if ($role == 'siswa') {
            $kelas = $user->kelas()->where('user_kelas.tahun_ajaran_id', $tahun_ajaran->id)->first();
            if ($kelas) {
                $kelas->pivot->update([
                    'kelas_id' =>$request->kelas_id
                ]);
            }else{
                $request->validate([
                    'kelas_id' => 'required'
                ]);
                
                DB::table('user_kelas')->insert([
                    'user_id' => $user->id,
                    'kelas_id' => $request->kelas_id,
                    'tahun_ajaran_id' => $tahun_ajaran->id
                ]);
            }
            app('App\Http\Controllers\ProfileSiswaController')->update($user, $request);
        }else{
            app('App\Http\Controllers\ProfileUserController')->update($user, $request, $role);
        }

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$role]), $request,  'Berhasil mengupdate ' . $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $user = User::findOrFail($id);

        if ($user->hasRole('guru')) {
            if (count($user->mapel) > 0) {
                foreach ($user->mapel as $key => $mapel) {
                    $mapel->user()->detach($user->id);
                }
            }

            if(count($user->agenda) > 0){
                foreach ($user->agenda as $key => $agenda) {
                    $agenda->update([
                        'user_id' => null
                    ]);
                }
            }

            if(count($user->absensi_pelajaran) > 0){
                foreach ($user->absensi_pelajaran as $key => $absensi_pelajaran) {
                    $absensi_pelajaran->update([
                        'user_id' => null
                    ]);
                }
            }

        }
        
        if (count($user->absensi) > 0) {
            foreach ($user->absensi as $key => $absensi) {
                $absensi->delete();
            }
        }

        if ($user->rfid) {
            $user->rfid->delete();
        }

        $user->delete();

        return TahunAjaran::redirectWithTahunAjaranManual('/users/' . $user->getRoleNames()[0], $request, 'Berhasil menghapus ' . $user->getRoleNames()[0]);
    }

    public function import(Request $request, $role){
        $data = ['role' => $role];
        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma') {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => DB::table('kelas')->where('kelas.sekolah_id', Auth::user()->sekolah_id)
                                                    ->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)->get()];
        }
        return view('users.import',$data);
    }

    public function store_import(Request $request, $role){
        $excel = Excel::import(new UsersImport($role, $request), $request->file('file'));
        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$role]), $request,  'Berhasil mengimport ' . $role);
    }

    public function export(Request $request, $role){
        return Excel::download(new UsersExport($role, $request), $role.'.xlsx');
    }

    public function createYayasan(){
        $yayasan = User::whereHas("roles", function($q) { $q->where("name", 'yayasan'); })->where('sekolah_id', \Auth::user()->sekolah_id)->first();

        if (!$yayasan) {
            return view('createYayasan');
        }else{
            abort(403);
        }
    }

    public function storeYayasan(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = \Hash::make($request->password);
        $validatedData['sekolah_id'] = \Auth::user()->sekolah_id;

        $user = User::create($validatedData);
        $user->assignRole('yayasan');

        return TahunAjaran::redirectWithTahunAjaranManual('/', $request, 'Berhasil menambahkan yayasan');
    }
}
