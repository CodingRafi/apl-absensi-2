<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\User;
use Hash, Session;

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
            'role' => 'required',
            'login' => 'required',
            'password' => 'required'
        ]);

        $role = $request->role;

        if ($role == 'siswa') {
            $siswa = DB::table('siswas')->where('nipd', $request->nipd)->first();
            if (Auth::guard('websiswa')->attempt(['nipd' => $request->login, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);    
            }else{
                return redirect()->back()->with('msg_error', 'Login Failed');
            }
        }else{
            if ($role == 'super_admin' || $role == 'yayasan' || $role == 'admin') {
                $user = User::where('email', $request->login)->first();
                if ($user && Hash::check($request->password, $user->password)) {
                    if ($user->hasRole($role)) {
                        // dd(Session::regenerate());
                        Session::regenerate();
                        return redirect()->route('dashboard')->with('msg_success', 'Success Login');    
                    }else{
                        return redirect()->back()->with('msg_error', 'Login Failed');
                    }
                }else{
                    return redirect()->back()->with('msg_error', 'Login Failed');
                }
            }else{
                $user = User::where('nip', $request->login)->first();
                if ($user && Hash::check($request->password, $user->password)) {
                    if ($user->hasRole($role)) {
                        $request->session()->regenerate();
                        return redirect()->intended(RouteServiceProvider::HOME);    
                    }else{
                        return redirect()->back()->with('msg_error', 'Login Failed');
                    }
                } else {
                    return redirect()->back()->with('msg_error', 'Login Failed');
                }
                
            }
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
