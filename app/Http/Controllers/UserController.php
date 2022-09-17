<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Rfid;
use App\Models\TahunAjaran;
use App\Models\JedaPresensi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:view_users|add_users|edit_users|delete_users', ['only' => ['index','store']]);
         $this->middleware('permission:add_users', ['only' => ['create','store']]);
         $this->middleware('permission:edit_users', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_users', ['only' => ['destroy']]);
         $this->middleware('permission:import_users', ['only' => ['import', 'saveimport']]);
         $this->middleware('permission:export_users', ['only' => ['export']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {   
        $users_query = User::filter(request(['search']))->where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $users = [];

        foreach ($users_query as $key => $user) {
            if($user->hasRole($role)){
                $users[] = $user;
            }
        }

        return view('users.index', [
            'users' => $users,
            'role' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $role)
    {   
        $roleQuery = Role::where('name', $role)->first();
        $jedas = JedaPresensi::where('role_id', $roleQuery->id)->where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('users.create', [
            'role' => $role,
            'mapels' => $mapels,
            'jedas' => $jedas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users'), Rule::unique('siswas')],
            'password' => 'required', 
            'nip' => 'required|unique:users', 
            'jk' => 'required', 
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'agama' => 'required', 
            'jalan' => 'required', 
            'kelurahan' => 'required', 
            'kecamatan' => 'required', 
            'role' => 'required',
            'rfid_number' => 'required|unique:rfids',
            'status_rfid' => 'required',
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024'
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password), 
            'nip' => $request->nip, 
            'jk' => $request->jk, 
            'tempat_lahir' => $request->tempat_lahir, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'agama' => $request->agama, 
            'jalan' => $request->jalan, 
            'kelurahan' => $request->kelurahan, 
            'kecamatan' => $request->kecamatan,
            'sekolah_id' => \Auth::user()->sekolah_id,
            'jeda_presensi_id' => $request->jeda_presensi_id,
            'email' => $request->email
        ];

        if($request->profil){
            $data += ['profil' => $request->file('profil')->store('profil')];
        }

        $user = User::create($data);

        $user->assignRole($request->role);
        if($request->role == 'guru'){
            $user->mapel()->attach($request->mapel);
        }

        if ($request->rfid_number) {
            Rfid::createRfid($request->rfid_number, null, $user->id, $request->status_rfid);
        }

        return TahunAjaran::redirectTahunAjaran('/users/' . $request->role, $request,  'Berhasil menambahkan ' . $request->role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = $user->getRoleNames()[0];
        $roleQuery = Role::where('name', $role)->first();
        $jedas = JedaPresensi::where('role_id', $roleQuery->id)->where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        return view('users.update', [
            'user' => $user,
            'role' => $role,
            'mapels' => $mapels,
            'jedas' => $jedas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'nip' => ['required', Rule::unique('users')->ignore($user->id)], 
            'jk' => 'required', 
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'agama' => 'required', 
            'jalan' => 'required', 
            'kelurahan' => 'required', 
            'kecamatan' => 'required', 
            'role' => 'required',
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024',
            'jeda_presensi_id' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id), Rule::unique('siswas')]
        ]);

        $rfid = $user->rfid;
        if ($rfid) {
            $request->validate([
                'rfid_number' => [Rule::unique('rfids')->ignore($rfid->id)],
            ]);
        }

        if ($request->file('profil')) {
            if($user->profil != '/img/profil'){
                Storage::delete($user->profil);
            }
            $validatedData['profil'] = $request->file('profil')->store('profil');
        }

        $user->update($validatedData);
        if($request->role == 'guru'){
            $user->mapel()->sync($request->mapel);
        }
        
        if($request->id_rfid){
            Rfid::updateRfid($request);
        }else if($request->rfid){
            Rfid::createRfid($request->rfid, null, $user->id, $request->status_rfid ?? 'tidak');
        }

        return TahunAjaran::redirectTahunAjaran('/users/' . $request->role, $request,  'Berhasil mengupdate ' . $request->role);
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
                    $agenda->delete();
                }
            }

            if(count($user->absensi_pelajaran) > 0){
                foreach ($user->absensi_pelajaran as $key => $absensi_pelajaran) {
                    $absensi_pelajaran->delete();
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

        return TahunAjaran::redirectTahunAjaran('/users/' . $user->getRoleNames()[0], $request, 'Berhasil menghapus ' . $user->getRoleNames()[0]);
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
        foreach ($users as $key => $user) {
            if (array_key_exists("email",$user) && array_key_exists("nip",$user)) {     
                if($user['name'] != null && $user['email'] != null && $user['nip'] != null){
                    $user = User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'nip' => $user['nip'],
                        'jk' => ($user['jk'] == 'L' || $user['jk'] == 'P') ? strtoupper($user['jk']) : null,
                        'tempat_lahir' => $user['tempat_lahir'],
                        'tanggal_lahir' => Siswa::filterDate($user['tanggal_lahir']),
                        'agama' => $user['agama'],
                        'jalan' => $user['jalan'],
                        'kelurahan' => $user['kelurahan'],
                        'kecamatan' => $user['kecamatan'],
                        'password' => \Hash::make('12345678'),
                        'sekolah_id' => \Auth::user()->sekolah_id,
                        'jeda_presensi_id' => $request->jeda_presensi_id
                    ]);
    
                    $user->assignRole($role);
                }
            }else{
                return TahunAjaran::redirectTahunAjaran('/import/users/' . $role, $request, 'kolom tidak valid');
            }
        }

        return TahunAjaran::redirectTahunAjaran('/users/' . $role, $request,  'Berhasil mengimport');
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
                    'agama' => $user->agama,
                    'jalan' => $user->jalan,
                    'kelurahan' => $user->kelurahan,
                    'kecamatan' => $user->kecamatan,
                    'sesi' => ($user->jeda_presensi) ? $user->jeda_presensi->nama : ''
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
    // dd($yayasan);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = \Hash::make($request->password);
        $validatedData['sekolah_id'] = \Auth::user()->sekolah_id;

        $user = User::create($validatedData);
        $user->assignRole('yayasan');


        return TahunAjaran::redirectTahunAjaran('/', $request, 'Berhasil menambahkan yayasan');
    }
}
