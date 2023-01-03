<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\User;
use Hash, Session, DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   $count_tahun_ajaran = DB::table('tahun_ajarans')->count();
        return view('myauth.login', compact('count_tahun_ajaran'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {   
        $request->validate([
            'role' => 'required',
            'login' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::when($request->role == 'super_admin' || $request->role == 'admin' || $request->role == 'yayasan', function($q) use($request){
                    $q->where('email', $request->login);
                })
                ->when($request->role == 'siswa', function($q) use($request){
                    $q->where('nipd', $request->login);
                })
                ->when($request->role != 'super_admin' && $request->role != 'admin' && $request->role != 'yayasan' && $request->role != 'siswa', function($q) use($request){
                    $q->where('nip', $request->login);
                })
                ->first();
                
        if ($user && $user->hasRole($request->role) && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended(RouteServiceProvider::HOME); 
        } else {
            return redirect()->back()->with('msg_error', 'Login Failed');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
