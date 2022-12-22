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
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

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
                            ->join('kelas', 'profile_siswas.kelas_id', 'kelas.id')
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

    public function store(StoreUserRequest $request)
    {   
        $data = [
            'profil' => isset($data['profil']) ? $data['profil'] : '/img/profil.png',
            'password' => Hash::make($request->password),
            'sekolah_id' => Auth::user()->sekolah_id,
            'email' => $request->email
        ];

        if ($request->role == 'siswa') {
            $request->validate([
                'nipd' => 'required|unique:users'
            ]);
            $data += ['nipd' => $request->nipd];
        }else{
            $request->validate([
                'nip' => 'required|unique:users'
            ]);
            $data += ['nip' => $request->nip];
        }
        
        $user = User::create($data);
        $user->assignRole($request->role);

        if ($request->role == 'siswa') {
            app('App\Http\Controllers\ProfileSiswaController')->store($user, $request);
        }else{
            app('App\Http\Controllers\ProfileUserController')->store($user, $request);
        }

        if ($request->rfid_number) {
            Rfid::create([
                'rfid_number' => $number_rfid,
                'user_id' => $user->id,
                'status' => ($status == 'on') ? 'aktif' : 'tidak'
            ]);
        }

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$request->role]), $request,  'Berhasil menambahkan ' . $request->role);
    }

    
    public function show($role, $id){
        $this->check_user($id, $role);
        dd($role);
    }

    public function edit(Request $request, $role, $id)
    {   
        $this->check_user($id, $role);

        $user = User::when($role == 'siswa', function ($q) use($role) {
                    return $q->select('users.*', 'profile_siswas.*', 'users.id as id')->join('profile_siswas', 'profile_siswas.user_id', 'users.id');
                })->when($role != 'siswa', function($q) use($role){
                    return $q->select('users.*', 'profile_users.*','users.id as id')
                            ->join('profile_users', 'profile_users.user_id', 'users.id');
                })->where('users.id', $id)->first();

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
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
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
        
        if ($request->role == 'siswa') {
            $request->validate([
                'nipd' => ['required', Rule::unique('users')->ignore($user->id)], 
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

        if ($request->role == 'siswa') {
            app('App\Http\Controllers\ProfileSiswaController')->update($user, $request);
        }else{
            app('App\Http\Controllers\ProfileUserController')->update($user, $request);
        }

        return TahunAjaran::redirectWithTahunAjaranManual(route('users.index', [$request->role]), $request,  'Berhasil mengupdate ' . $request->role);
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

    public function import($role){
        $roleQuery = Role::where('name', $role)->first();
        $jedas = JedaPresensi::where('role_id', $roleQuery->id)->get();
        return view('users.import',[
            'role' => $role,
            'jedas' => $jedas
        ]);
    }

    public function saveimport(Request $request, $role){
        $users = (new FastExcel)->import($request->file);
        $berhasil = 0;
        $gagal = 0;

        foreach ($users as $key => $user) {
            if (array_key_exists("email",$user) && array_key_exists("nip",$user)) {     
                $cekUser = User::where('email', $user['email'])->orWhere('nip', $user['nip'])->first();
                
                if ($cekUser) {
                    $gagal++;
                }else{
                    $agama = ref_agama::where('nama', 'LIKE', '%' . $user['agama'] . '%')->first();
                    $user = User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'nip' => $user['nip'],
                        'jk' => ($user['jk'] == 'L' || $user['jk'] == 'P') ? strtoupper($user['jk']) : null,
                        'tempat_lahir' => $user['tempat_lahir'],
                        'tanggal_lahir' => Siswa::filterDate($user['tanggal_lahir']),
                        'agama' => $agama ? $agama->id : '',
                        'jalan' => $user['jalan'],
                        'kecamatan' => $user['kecamatan'],
                        'kelurahan' => $user['kelurahan'],
                        'kota_kab' => $user['kota_kab'],
                        'provinsi' => $user['provinsi'],
                        'password' => \Hash::make('12345678'),
                        'sekolah_id' => \Auth::user()->sekolah_id
                    ]);
    
                    $user->assignRole($role);
                    $berhasil++;
                }
            }else{
                return TahunAjaran::redirectWithTahunAjaranManual('/import/users/' . $role, $request, 'kolom tidak valid');
            }
        }

        return TahunAjaran::redirectWithTahunAjaranManual('/users/' . $role, $request,  'Berhasil ' . $berhasil . ','. 'Gagal '. $gagal );
    }

    public function export(Request $request, $role){
        $users_query = User::filter(request(['search']))->where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $users = [];
        
        foreach ($users_query as $key => $user) {
            if($user->hasRole($role)){
                $users[] = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'nip' => $user->nip,
                    'jk' => $user->jk,
                    'tempat_lahir' => $user->tempat_lahir,
                    'tanggal_lahir' => $user->tanggal_lahir,
                    'agama' => $user->ref_agama? $user->ref_agama->nama : '',
                    'jalan' => $user->jalan,
                    'kelurahan' => $user->kelurahan,
                    'kecamatan' => $user->kecamatan,
                    'kota_kab' => $user->kota_kab,
                    'provinsi' => $user->provinsi,
                ];
            }
        }

        return (new FastExcel(collect($users)))->download('file.xlsx');
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
