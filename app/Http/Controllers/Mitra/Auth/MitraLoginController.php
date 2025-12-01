<?php

namespace App\Http\Controllers\Mitra\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MitraLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.mitra_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('mitra')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('mitra')->user();
            if ($user->hasRole('mitra')) {
                $request->session()->regenerate();
                return redirect()->intended(route('mitra.dashboard'));
            } else {
                Auth::guard('mitra')->logout();
                return back()->withErrors(['email' => 'Akun ini tidak memiliki akses sebagai mitra.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('mitra')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('mitra.login');
    }
}
