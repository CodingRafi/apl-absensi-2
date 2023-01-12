<?php

namespace App\Http\Controllers;

use Auth, DB;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Sekolah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(Request $request){ 
        if (\Auth::user()->hasRole('super_admin')) {
            $roles = Role::all();
            $sekolah = Sekolah::all();
            $tahun_ajarans = TahunAjaran::all();
            $countRole = Role::all()->count() - 1;
            $countSekolah = Sekolah::all()->count();
            $countTahunAjaran = TahunAjaran::all()->count();

            return view('dashboard', [
                'roles' => $roles,
                'sekolah' => $sekolah,
                'tahun_ajarans' => $tahun_ajarans,
                'countRole' => $countRole,
                'countSekolah' => $countSekolah,
                'countTahunAjaran' => $countTahunAjaran
            ]);

        }else {
            $tahun_ajaran = TahunAjaran::getTahunAjaran($request);
            $return = [];

            if (auth()->user()->can('view_users')) {
                //! Data User 
                $users = [
                    'key' => [],
                    'data' => []
                ];
    
                $roles = Role::select('roles.name')
                                ->where('roles.name', '!=', 'super_admin')
                                ->where('roles.name', '!=', 'admin')
                                ->where('roles.name', '!=', 'yayasan')
                                ->get();
    
                foreach ($roles as $key => $role) {
                    $count = User::role($role->name)
                    ->where('sekolah_id', Auth::user()->sekolah_id)
                    ->when($role == 'siswa', function($q) use($tahun_ajaran, $role) {
                        $q->join('profile_siswas', 'profile_siswas.user_id', 'users.id')
                            ->where('profile_siswas.tahun_ajaran_id', $tahun_ajaran->id);
                    })
                    ->count();
    
                    array_push($users['key'], ucfirst($role->name));
                    array_push($users['data'], $count);
                }

                $return += [
                    'users' => $users,
                    'yayasan' => User::role('yayasan')->where('sekolah_id', Auth::user()->sekolah_id)->first()
                ];
            }

            if (auth()->user()->can('view_kompetensi')) {
                //! Kompetensi
                $kompetensis = $this->parseData(DB::table('kompetensis')
                                ->select(DB::raw('count(profile_siswas.id) as jml'), 'kompetensis.kompetensi as key')
                                ->join('profile_siswas', 'profile_siswas.kompetensi_id', 'kompetensis.id')
                                ->join('users', 'users.id', 'profile_siswas.user_id')
                                ->where('users.sekolah_id', Auth::user()->sekolah_id)
                                ->groupBy('kompetensis.id')
                                ->get()->toArray());
                $return += ['kompetensis' => $kompetensis];
            }
            
            if (auth()->user()->can('view_mapel')) {
                //! Mapel
                $mapels = $this->parseData(DB::table('mapels')
                                ->select(DB::raw('count(mapel_user.user_id) as jml'), 'mapels.nama as key')
                                ->join('mapel_user', 'mapel_user.mapel_id', 'mapels.id')
                                ->where('mapels.sekolah_id', Auth::user()->sekolah_id)
                                ->groupBy('mapels.id')
                                ->get()->toArray()); 
                $return += ['mapels' => $mapels];
            }

            if (auth()->user()->can('view_kelas')) {
                //! Kelas
                // $kelas = $this->parseData(DB::table('kelas')
                //         ->select(DB::raw('count(profile_siswas.id) as jml'), 'kelas.nama as key')
                //         ->join('profile_siswas', 'profile_siswas.kelas_id', 'kelas.id')
                //         ->join('users', 'users.id', 'profile_siswas.user_id')
                //         ->where('users.sekolah_id', Auth::user()->sekolah_id)
                //         ->groupBy('kelas.id')
                //         ->get()->toArray());
                $kelas = [
                    'key' => [],
                    'data' => []
                ];

                $return += ['kelas' => $kelas];
            }

            if (auth()->user()->can('show_absensi')) {
                $absensis = [];
                $status_kehadirans = DB::table('status_kehadirans')->get();

                foreach ($status_kehadirans as $key => $status) {
                    $presensi = [];
                    foreach (config('services.bulan') as $i => $bulan) {
                        $data = DB::table('absensis')
                                ->select(DB::raw('count(absensis.id) as jml'))
                                ->where('absensis.tahun_ajaran_id', $tahun_ajaran->id)
                                ->where('absensis.status_kehadiran_id', $status->id)
                                ->where('absensis.user_id', Auth::user()->id)
                                ->whereMonth('absensis.presensi_masuk', $i+1)
                                ->groupBy('absensis.status_kehadiran_id')
                                ->first();
                        $presensi[] = $data ? $data->jml : 0;
                    }

                    $absensis[] = [
                        'label' => $status->nama,
                        'fill' => false,
                        'lineTension' => .3,
                        'borderColor' => $status->color,
                        'pointBorderWidth' => 1,
                        'pointHoverRadius' => 8,
                        'pointHoverBorderWidth' => 2,
                        'pointRadius' => 4,
                        'data' => $presensi,
                        'spanGaps' => true,
                    ];
                }
                
                $return += ['absensis' => $absensis];
            }

            return view('dashboard', $return);
        }
    }

    private function parseData($datas){
        $result = [
            'key' => [],
            'data' => []
        ];
        foreach ($datas as $key => $data) {
            array_push($result['key'], ucfirst($data->key));
            array_push($result['data'], $data->jml);
        }
        return $result;
    }
}
