<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Skip real auth for now, redirect to placeholder home with role
        $role = $request->string('role', 'alumni');
        return redirect()->route('home', ['role' => $role]);

        // If you later enable real auth, move the code below back:
        // if (Auth::attempt($credentials, $request->boolean('remember'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/');
        // }
        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ])->onlyInput('email');
    }
}


