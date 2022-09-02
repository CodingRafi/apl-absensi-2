<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ConfigurasiUserController extends Controller
{
    public function index(){
        return view('myauth.settings');
    }

    public function editProfil(){
        return view('myauth.editProfile');   
    }

    public function saveProfil(Request $request){
        $user = User::find(\Auth::user()->id);
        $validatedData = $request->validate([
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024',
            'name' => 'required',
            'email' =>  ['required', 'email', Rule::unique('users')->ignore($user->id)]
        ]);

        if ($request->email != $user->email) {
            $validatedData['email'] = $request->email;
        }

        if ($request->file('profil')) {
            if ($user->profil != '/img/profil.png') {
                Storage::delete($user->profil);
            }
            $validatedData['profil'] = $request->file('profil')->store('profil');
        }

        \DB::table('users')->where('id', \Auth::user()->id)->update($validatedData);

        if ($request->email != $user->email) {
            \Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        }

        return TahunAjaran::redirectTahunAjaran('/user-settings', $request, 'Profil Berhasil Diupdate');
    }

    public function ubahPassword(){
        return view('myauth.ubahpassword');
    }

    public function reset_password(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::where('email', \Auth::user()->email)->get()->first();
        $user->update([
            'password' => \Hash::make($request->password)
        ]);

        \Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
