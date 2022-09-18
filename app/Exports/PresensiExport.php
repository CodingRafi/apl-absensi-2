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

class PresensiExport implements FromView
{
    protected $presensis;
    protected $siswas;
    protected $date;
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($presensis, $siswas ,$date) {
        $this->presensis = $presensis;
        $this->siswas = $siswas;
        $this->date = $date;
    }

    public function view(): View
    {
        return view('absensipelajaran.export', [
            'presensis' => $this->presensis,
            'siswas' => $this->siswas,
            'date' => $this->date,
        ]);
    }
}
