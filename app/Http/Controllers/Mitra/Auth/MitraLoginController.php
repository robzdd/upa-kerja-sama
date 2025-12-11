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

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.mitra_forgot_password');
    }

    /**
     * Send reset link email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if email exists and belongs to a mitra user
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Verify user has mitra role
        if (!$user->hasRole('mitra')) {
            return back()->withErrors(['email' => 'Email ini tidak terdaftar sebagai mitra. Silakan gunakan halaman reset password yang sesuai.']);
        }

        $status = \Illuminate\Support\Facades\Password::broker('mitra')->sendResetLink(
            $request->only('email')
        );

        if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            return back()->with(['status' => 'Link reset password telah dikirim ke email Anda!']);
        }

        if ($status === \Illuminate\Support\Facades\Password::RESET_THROTTLED) {
            return back()->withErrors(['email' => 'Harap tunggu beberapa saat sebelum meminta link reset password lagi.']);
        }

        return back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim email.']);
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.mitra_reset_password', ['token' => $token, 'email' => request('email')]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = \Illuminate\Support\Facades\Password::broker('mitra')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => \Illuminate\Support\Facades\Hash::make($password)
                ])->save();
            }
        );

        return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
                    ? redirect()->route('mitra.login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.')
                    : back()->withErrors(['email' => 'Token reset password tidak valid atau sudah kadaluarsa.']);
    }
}
