<?php

namespace App\Imports;

use Auth, Hash, DB;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\profile_user;
use App\Models\profile_siswa;
use Illuminate\Support\Collection;  
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    protected $role;
    protected $request;

    public function __construct($role, $request){
        $this->role = $role;
        $this->request = $request;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_lengkap' => 'required',
            '*.email' => 'required|unique:users',
            '*.tempat_lahir' => 'required',
            '*.jenis_kelamin' => 'required',
            '*.tanggal_lahir' => 'required',
            '*.agama' => 'required',
            '*.provinsi' => 'required',
            '*.kotakabupaten' => 'required',
            '*.kecamatan' => 'required',
            '*.kelurahan' => 'required',
            '*.jalan' => 'required',
        ])->validate();

        if ($this->role == 'siswa') {
            Validator::make($rows->toArray(), [
                '*.nipd' => 'required|unique:users',
                '*.nisn' => 'required|unique:profile_siswas'
            ])->validate();
        }else{
            Validator::make($rows->toArray(), [
                '*.nip' => 'required|unique:users',
            ])->validate();
        }
        
        foreach ($rows as $row) {
            $agama = DB::table('ref_agamas')->where('nama', 'LIKE', '%'. $row['agama'] .'%')->first();
            $provinsi = DB::table('ref_provinsis')->where('nama', 'LIKE', '%'. $row['provinsi'] .'%')->first();
            $kabupaten = DB::table('ref_kabupatens')->where('nama', 'LIKE', '%'. $row['kotakabupaten'] .'%')->first();
            $kecamatan = DB::table('ref_kecamatans')->where('nama', 'LIKE', '%'. $row['kecamatan'] .'%')->first();
            $kelurahan = DB::table('ref_kelurahans')->where('nama', 'LIKE', '%'. $row['kelurahan'] .'%')->first();
            
            $data_user = [
                'email' => $row['email'],
                'sekolah_id' => Auth::user()->sekolah_id,
                'password' => Hash::make('*123456*')
            ];

            if ($this->role == 'siswa') {
                $data_user += ['nipd' => $row['nipd']];
            } else {
                $data_user += ['nip' => $row['nip']];
            }

            $user = User::create($data_user);
            $user->assignRole($this->role);

            if ($this->role == 'siswa') {
                $tahun_ajaran = TahunAjaran::getTahunAjaran($this->request);
                $user->kelas()->syncWithPivotValues([$this->request->kelas_id], ['tahun_ajaran_id' => $tahun_ajaran->id]);
                profile_siswa::create([
                    'user_id' => $user->id,
                    'name' => $row['nama_lengkap'],
                    'nisn' => $row['nisn'],
                    'nipd' => $row['nipd'],
                    'nik' => $row['nik'],
                    'kompetensi_id' => $this->request->kompetensi_id,
                    'jk' => (preg_match("/". $row['jenis_kelamin'] ."/i", 'perempuan') ? 'P' : 'L'),
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'ref_agama_id' => $agama ? $agama->id : '',
                    'ref_provinsi_id' => $provinsi ? $provinsi->id : '',
                    'ref_kabupaten_id' => $kabupaten ? $kabupaten->id : '',
                    'ref_kecamatan_id' => $kecamatan ? $kecamatan->id : '',
                    'ref_kelurahan_id' => $kelurahan ? $kelurahan->id : '',
                    'jalan' => $row['jalan'],
                    'tahun_ajaran_id' => $tahun_ajaran->id
                ]);
            }else{
                profile_user::create([
                    'user_id' => $user->id,
                    'name' => $row['nama_lengkap'],
                    'jk' => (preg_match("/". $row['jenis_kelamin'] ."/i", 'perempuan') ? 'P' : 'L'),
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'ref_agama_id' => $agama ? $agama->id : '',
                    'ref_provinsi_id' => $provinsi ? $provinsi->id : '',
                    'ref_kabupaten_id' => $kabupaten ? $kabupaten->id : '',
                    'ref_kecamatan_id' => $kecamatan ? $kecamatan->id : '',
                    'ref_kelurahan_id' => $kelurahan ? $kelurahan->id : '',
                    'jalan' => $row['jalan'],
                ]);
            }
        }
    }
}
