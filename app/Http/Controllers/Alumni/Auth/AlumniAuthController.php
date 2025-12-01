<?php

namespace App\Http\Controllers\Alumni\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AlumniAuthController extends Controller
{
    /**
     * Tampilkan halaman login alumni
     */
    public function showLoginForm()
    {
        return view('auth.alumni_login_page');
    }

    /**
     * Tampilkan halaman register alumni
     */
    public function showRegisterForm()
    {
        $googleData = session('google_register_data');
        return view('auth.alumni_register_page', compact('googleData'));
    }

    /**
     * Proses register alumni
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'google_id' => ['nullable', 'string'],
        ]);

        // Jika manual register (tanpa google_id), password wajib
        if (!$request->google_id && !$request->password) {
            throw ValidationException::withMessages([
                'password' => 'Password wajib diisi.',
            ]);
        }

        // Buat User
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : bcrypt(\Illuminate\Support\Str::random(16)),
            'google_id' => $request->google_id,
        ]);

        $user->assignRole('alumni');

        // Buat Data Alumni
        \App\Models\Alumni::create([
            'user_id' => $user->id,
        ]);

        // Login
        Auth::login($user);

        // Hapus session google jika ada
        session()->forget('google_register_data');

        return redirect()->route('alumni.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
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

                if ($request->wantsJson()) {
                    return response()->json([
                        'message' => 'Login berhasil',
                        'user' => $user
                    ]);
                }

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
