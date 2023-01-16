<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function check_user($id, $role){
        if ($role !== 'kelas') {
            $data = User::findOrFail($id);
            if (!$data->hasRole($role)) {
                return abort(403);
            }
    
            if ($data->sekolah->id != \Auth::user()->sekolah->id) {
                return abort(403);
            }
        }
    }

    protected function getDate(){
        $now = Carbon::now();
        $month = $now->year . '-' . (int) (request('bulan') ?? $now->month);
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $date = [];
        while ($start->lte($end)) {
            $date[] = Carbon::parse($start->copy())->format('Y-m-d');
            $start->addDay();
        }

        return $date;
    }

    public function parseDataToArray($datas){
        $return = [];

        foreach ($datas as $key => $data) {
            array_push($return, $data->id);
        }

        return $return;
    }
}
