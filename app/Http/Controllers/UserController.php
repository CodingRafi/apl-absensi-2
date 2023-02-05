<?php

namespace App\Http\Controllers;

use DB, Hash, Auth;
use App\Models\Rfid;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Kelas;
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
use Illuminate\Validation\ValidationException;

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
        $users = User::getUser($request, $role, false, true);
        $data = [
            'users' => $users,
            'role' => $role
        ];
        
        $users = User::role('siswa');
        
        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if (check_jenjang()) {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => Kelas::getKelas($request)];
            
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
            if (check_jenjang()) {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => Kelas::getKelas($request)];
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
         
        if ($request->file('profil')) {
            $data['profil'] = $request->file('profil')->store('profil');
            // dd($data);
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
                'rfid_number' => $request->rfid_number,
                'user_id' => $user->id,
                'status' => ($request->status_rfid ? (($request->status_rfid == 'on') ? 'aktif' : 'tidak') : 'tidak')
            ]);
        }

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$role]), $request,  'Berhasil menambahkan ' . $role);
    }

    
    public function show(Request $request, $role, $id){
        $this->check_user($id, $role);
        $user = User::findUser($request, $role, $id);
        return view('users.show', compact('user', 'role'));
    }

    public function edit(Request $request, $role, $id)
    {   
        $this->check_user($id, $role);
        $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
        
        $user = User::findUser($request, $role, $id);

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
            if (check_jenjang()) {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => Kelas::getKelas($request)];
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
    public function destroy(Request $request, $role, $id)
    {   
        User::deleteUser($role, $id);

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$role]), $request,  'Berhasil menghapus ' . $role);
    }

    public function import(Request $request, $role){
        $data = ['role' => $role];
        if ($role == 'siswa') {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            if (check_jenjang()) {
                $data += ['kompetensis' => DB::table('kompetensis')->where('sekolah_id', Auth::user()->sekolah_id)->get()];
            }
            $data += ['kelas' => Kelas::getKelas($request)];
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

    public function down(Request $request, $id){
        $user = User::findOrFail($id);

        if ($user->hasRole('siswa')) {
            if ($user->kelas->count() > 1) {
                $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
                $kelas_latest = DB::table('users')->select('ref_tingkats.key')
                                                    ->join('user_kelas', 'user_kelas.user_id', 'users.id')
                                                    ->join('kelas', 'kelas.id', 'user_kelas.kelas_id')
                                                    ->join('ref_tingkats', 'ref_tingkats.id', 'kelas.ref_tingkat_id')
                                                    ->orderBy('ref_tingkats.key', 'desc')
                                                    ->first();
    
                $kelas_request = $user->kelas()->where('tahun_ajaran_id', $tahun_ajaran->id)->first();
    
                if ($kelas_latest->key == $kelas_request->tingkat->key) {
                    $absensi_pelajaran = $user->absensi_pelajaran()->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
                    
                    foreach ($absensi_pelajaran as $key => $absensi) {
                        $absensi->delete();
                    }
    
                    $absensis = $user->absensi()->where('tahun_ajaran_id', $tahun_ajaran->id)->get();
    
                    foreach ($absensis as $key => $absensi) {
                        $absensi->delete();
                    }
    
                    $kelas_request->pivot->delete();
    
                    return redirect()->back()->with('msg_success', 'Berhasil di downgrade');
                } else {
                    return redirect()->back()->with('msg_error', 'tidak bisa di down ini bukan kelas yang paling tinggi');
                }
            } else {
                return redirect()->back()->with('msg_error', 'tidak bisa di down karena hanya tinggal 1 kelas saja');
            }
        }else{
            return redirect()->back()->with('msg_error', 'bukan siswa');
        }
    }
}
