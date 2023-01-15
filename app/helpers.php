<?php 

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