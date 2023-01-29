<?php 

use App\Models\{
    TahunAjaran,
    User
};


if (!function_exists('check_jenjang')) {

    function check_jenjang()
    {
        if (auth()->user()->sekolah->jenjang == 'smk' || auth()->user()->sekolah->jenjang == 'sma') {
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('get_kelas')) {

    function get_kelas($id)
    {
        $tahun_ajaran = TahunAjaran::getTahunAjaran();
        $kelas = User::findOrFail($id)->kelas()->where('tahun_ajaran_id', $tahun_ajaran->id)->first();
        return $kelas->id;
    }
}