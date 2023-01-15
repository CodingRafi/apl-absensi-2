<?php

namespace App\Exports;

use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    protected $role;
    protected $request;

    public function __construct($role, $request){
        $this->role = $role;
        $this->request = $request;
    }

    public function view(): View
    {   
        $users = User::getUser($this->request, $this->role, true);

        return view('users.export', [
            'users' => $users,
            'role' => $this->role
        ]);
    }
}
