<?php

namespace App\Http\Controllers\Alumni\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AlumniRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.alumni_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'alumni', // default
        ]);

        Auth::login($user);

        return redirect('/alumni/dashboard');
    }

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

        } catch (\Exception $e) {
            return redirect('/alumni/register')->with('error', 'Gagal daftar menggunakan Google.');
        }

        $user = User::where('email', $googleUser->getEmail())->first();
        if ($user) {
            return redirect('/alumni/register')->with('error', 'Email sudah terdaftar, silakan daftar.');
        }

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make('password'),
            'roles' => 'alumni',
            'google_id' => $googleUser->getId(),
        ]);

        Auth::login($user);

        return redirect('/alumni/dashboard');
    }
}
