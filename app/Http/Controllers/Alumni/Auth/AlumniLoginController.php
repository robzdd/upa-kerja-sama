<?php

namespace App\Http\Controllers\Alumni\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AlumniLoginController extends Controller
{
    /**
     * Tampilkan halaman login alumni
     */
    public function showLoginForm()
    {
        return view('auth.alumni_login_page');
    }

    /**
     * Proses login alumni
     */
    public function login(Request $request)
    {
        // 🔹 Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 🔹 Coba login dengan guard default (web)
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Pastikan user memiliki role 'alumni' (Spatie)
            if ($user->hasRole('alumni')) {
                $request->session()->regenerate();

                return redirect()
                    ->intended(route('alumni.dashboard'))
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }

            // Jika bukan alumni, logout kembali
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses sebagai alumni.',
            ]);
        }

        // 🔹 Jika gagal login
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout alumni
     */
    public function logout(Request $request)
    {
        Auth::logout(); // keluar dari session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('alumni.login')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
