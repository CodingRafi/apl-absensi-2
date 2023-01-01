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
    protected $date;
    protected $status_kehadiran;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($role, $absensis, $date, $status_kehadiran) {
        $this->role = $role;
        $this->absensis = $absensis;
        $this->date = $date;
        $this->status_kehadiran = $status_kehadiran;
    }

    public function view(): View
    {
        return view('absensi.export', [
            'role' => $this->role,
            'absensis' => $this->absensis,
            'date' => $this->date,
            'status_kehadiran' => $this->status_kehadiran,
        ]);
    }
}
