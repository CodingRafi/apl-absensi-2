<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Rfid;
use App\Models\ref_agama;
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
         $this->middleware('permission:view_users', ['only' => ['index','show']]);
         $this->middleware('permission:add_users', ['only' => ['create','store']]);
         $this->middleware('permission:edit_users', ['only' => ['edit','update']]);
         $this->middleware('permission:delete_users', ['only' => ['destroy']]);
         $this->middleware('permission:import_users', ['only' => ['import', 'saveimport']]);
         $this->middleware('permission:export_users', ['only' => ['export']]);
    }
    
    public function index(Request $request, $role)
    {   
        $users = User::filter(request(['search']))
                    ->role($role) 
                    ->where('sekolah_id', \Auth::user()->sekolah_id)
                    ->get();

        return view('users.index', [
            'users' => $users,
            'role' => $role
        ]);
    }

    public function create(Request $request, $role)
    {   
        $provinsis = DB::table('ref_provinsis')->get();
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $agamas = ref_agama::all();
        return view('users.create', compact('role', 'mapels', 'agamas', 'provinsis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users'), Rule::unique('siswas')],
            'password' => 'required', 
            'nip' => 'required|unique:users', 
            'jk' => 'required', 
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'ref_agama_id' => 'required', 
            'jalan' => 'required', 
            'kelurahan' => 'required', 
            'kecamatan' => 'required', 
            'kota_kab' => 'required', 
            'provinsi' => 'required', 
            'role' => 'required',
            'rfid_number' => 'unique:rfids',
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
            'ref_agama_id' => $request->ref_agama_id, 
            'jalan' => $request->jalan, 
            'kelurahan' => $request->kelurahan, 
            'kecamatan' => $request->kecamatan,
            'kota_kab' => $request->kota_kab,
            'provinsi' => $request->provinsi,
            'sekolah_id' => \Auth::user()->sekolah_id,
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

        return TahunAjaran::redirectWithTahunAjaranManual('/users/' . $request->role, $request,  'Berhasil menambahkan ' . $request->role);
    }

    
    public function show($role, $id){
        $this->check_user($id, $role);
        dd($role);
    }

    public function edit($role, $id)
    {   
        $this->check_user($id, $role);
        $data = User::findOrFail($id);
        $mapels = Mapel::where('sekolah_id', \Auth::user()->sekolah_id)->get();
        $agamas = ref_agama::all();
        return view('users.update', [
            'data' => $data,
            'role' => $role,
            'mapels' => $mapels,
            'agamas' => $agamas
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
            'ref_agama_id' => 'required', 
            'jalan' => 'required', 
            'kelurahan' => 'required', 
            'kecamatan' => 'required', 
            'kota_kab' => 'required', 
            'provinsi' => 'required', 
            'role' => 'required',
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024',
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
        }else if($request->rfid_number){
            Rfid::createRfid($request->rfid_number, null, $user->id, $request->status_rfid ?? 'tidak');
        }

        return TahunAjaran::redirectWithTahunAjaranManual('/users/' . $request->role, $request,  'Berhasil mengupdate ' . $request->role);
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
