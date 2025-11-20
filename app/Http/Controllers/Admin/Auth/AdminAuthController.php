<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan halaman login admin
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Pastikan user memiliki role 'admin'
            if ($user->hasRole('admin')) {
                $request->session()->regenerate();

                return redirect()
                    ->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }

            // Jika bukan admin, logout kembali
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses sebagai admin.',
            ]);
        }

        // Jika gagal login
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Anda telah berhasil logout.');
    }
}

