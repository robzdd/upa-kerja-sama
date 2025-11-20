<?php

namespace App\Http\Controllers\Alumni\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AlumniGoogleController extends Controller
{
    // =======================
    // LOGIN GOOGLE
    // =======================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // cari user
            $user = User::where('email', $googleUser->getEmail())->first();

            // jika tidak ditemukan → suruh register dulu
            if (!$user) {
                return redirect('/alumni/register')->with('error', 'Akun belum terdaftar, silakan daftar dulu.');
            }

            // login
            Auth::login($user);

            return redirect('/alumni/dashboard');

        } catch (\Exception $e) {
            return redirect('/alumni/login')->with('error', 'Gagal login menggunakan Google.');
        }
    }

    // =======================
    // REGISTER GOOGLE
    // =======================
    public function redirectToGoogleRegister()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallbackRegister()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // cek apakah email sudah terdaftar
            $existing = User::where('email', $googleUser->getEmail())->first();
            if ($existing) {
                return redirect('/alumni/register')->with('error', 'Email sudah terdaftar, silakan daftar.');
            }

            // create user baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt('password'),
                'roles' => 'alumni',
                'google_id' => $googleUser->getId(),
            ]);

            // login otomatis
            Auth::login($user);

            return redirect('/alumni/dashboard');

        } catch (\Exception $e) {
            return redirect('/alumni/register')->with('error', 'Gagal daftar menggunakan Google.');
        }
    }
}
