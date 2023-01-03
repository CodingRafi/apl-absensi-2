<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiPelajaranExport implements FromView
{
    protected $absensi_pelajaran;
    protected $absensis;
    protected $date;
    protected $status_kehadiran;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($absensi_pelajaran, $absensis, $date, $status_kehadiran) {
        $this->absensi_pelajaran = $absensi_pelajaran;
        $this->absensis = $absensis;
        $this->date = $date;
        $this->status_kehadiran = $status_kehadiran;
    }

    public function view(): View
    {
        return view('absensi_pelajaran.export', [
            'absensi_pelajaran' => $this->absensi_pelajaran,
            'absensis' => $this->absensis,
            'date' => $this->date,
            'status_kehadiran' => $this->status_kehadiran,
        ]);
    }
}
