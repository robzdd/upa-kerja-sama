<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $type = $request->query('type', 'login'); // default to login
        session(['google_auth_type' => $type]);
        
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');
            $googleUser = $driver->stateless()->user();
            $type = session('google_auth_type', 'login');
            session()->forget('google_auth_type');

            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($type === 'login') {
                // LOGIC LOGIN
                if (!$user) {
                    return redirect()->route('alumni.login')->with('error', 'Akun tidak ditemukan. Silakan registrasi terlebih dahulu.');
                }
                
                // Cek apakah user punya role alumni (jika perlu)
                if (!$user->hasRole('alumni')) {
                     return redirect()->route('alumni.login')->with('error', 'Akun ini bukan akun alumni.');
                }

                Auth::login($user);
                return redirect()->intended(route('alumni.dashboard'));

            } else {
                // LOGIC REGISTER
                if ($user) {
                    return redirect()->route('alumni.login')->with('info', 'Akun sudah terdaftar. Silakan login.');
                }

                // Simpan data google ke session untuk diisi di form register
                session([
                    'google_register_data' => [
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                    ]
                ]);

                return redirect()->route('alumni.register');
            }

        } catch (\Exception $e) {
            // Log error asli untuk debugging
            \Illuminate\Support\Facades\Log::error('Google Auth Error: ' . $e->getMessage());
            
            // Tampilkan pesan yang lebih user friendly
            return redirect()->route('alumni.login')->with('error', 'Gagal login dengan Google. Pastikan koneksi internet Anda stabil atau coba lagi nanti.');
        }
    }
}
