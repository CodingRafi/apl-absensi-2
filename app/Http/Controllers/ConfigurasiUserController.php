<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurasiUserController extends Controller
{
    public function index(){
        return view('myauth.settings');
    }
}
