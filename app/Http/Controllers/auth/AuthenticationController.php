<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function do_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session(['user' => Auth::user()]);
            if (Auth::user()->role == 0) {
                return redirect()->intended('/merchant/dashboard')->with('success', 'Login success');
            }

            if (Auth::user()->role == 1) {
                return redirect()->intended('/customer/dashboard')->with('success', 'Login success');
            }
        }

        return back()->withErrors(['fail' => 'Please input valid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session(['user' => null]);

        return redirect('/');
    }
}
