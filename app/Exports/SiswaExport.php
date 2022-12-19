<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SiswaExport implements FromView
{
    public $tahun_ajaran;
    public $tingkat;

    public function __construct($tahun_ajaran, $tingkat) {
        $this->tahun_ajaran = $tahun_ajaran;
        $this->tingkat = $tingkat;
    }

    public function view(): View
    {   
        $tahun_ajaran = $this->tahun_ajaran;
        $tingkat = $this->tingkat;
        $siswas = Siswa::filter(request(['idk', 'idj', 'search']))
                        ->select('siswas.*', 'kelas.nama as kelas', 'ref_agamas.nama as agama')
                        ->when(\Auth::user()->sekolah->tingkat == 'smk' || \Auth::user()->sekolah->tingkat == 'sma', function ($q) {
                            return $q->join('kompetensis', 'kompetensis.id', 'siswas.kompetensi_id')->addSelect('kompetensis.kompetensi');
                        })
                        ->join('kelas', 'kelas.id', 'siswas.kelas_id')
                        ->join('tahun_ajarans', 'kelas.tahun_ajaran_id', 'tahun_ajarans.id')
                        ->join('ref_agamas', 'ref_agamas.id', 'siswas.ref_agama_id')
                        ->where('kelas.tahun_ajaran_id', $tahun_ajaran->id)
                        ->where('kelas.sekolah_id', \Auth::user()->sekolah_id)
                        ->get();

        return view('siswa.export', compact('siswas', 'tingkat'));
    }
}
