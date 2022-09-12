<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Rfid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    protected $role;
    protected $absensis;
    protected $siswas;
    protected $users;
    protected $date;
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($role, $absensis, $siswas = null, $users = null, $date) {
        $this->role = $role;
        $this->absensis = $absensis;
        $this->siswas = $siswas;
        $this->users = $users;
        $this->date = $date;
    }

    public function view(): View
    {
        if($this->role == 'siswa'){
            return view('exportAbsensi', [
                'role' => $this->role,
                'absensis' => $this->absensis,
                'siswas' => $this->siswas,
                'date' => $this->date,
            ]);
        }else{
            return view('exportAbsensi', [
                'role' => $this->role,
                'users' => $this->users,
                'absensis' => $this->absensis,
                'date' => $this->date,
            ]);
        }
    }
}
