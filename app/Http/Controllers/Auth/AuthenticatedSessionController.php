<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('myauth.login');
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
            'login' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->login, 'password' => $request->password]) || Auth::guard('web')->attempt(['nip' => $request->login, 'password' => $request->password]) || Auth::guard('websiswa')->attempt(['nipd' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
    
            return redirect()->intended(RouteServiceProvider::HOME);     
        }else{
            return redirect()->back()->with('msg_success', 'Login Gagal');
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
