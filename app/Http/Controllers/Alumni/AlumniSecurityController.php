<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AlumniSecurityController extends Controller
{
    /**
     * Display security settings page
     */
    public function settings()
    {
        $user = Auth::user();
        return view('alumni.pengaturan_keamanan', compact('user'));
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi lama harus diisi',
            'new_password.required' => 'Kata sandi baru harus diisi',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi lama tidak sesuai');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Kata sandi berhasil diubah');
    }

    /**
     * Deactivate user account
     */
    public function deactivateAccount()
    {
        $user = Auth::user();
        
        // Set account as inactive (you may need to add is_active column to users table)
        $user->is_active = false;
        $user->save();

        // Logout user
        Auth::logout();

        return redirect()->route('alumni.login')->with('success', 'Akun berhasil dinonaktifkan');
    }

    /**
     * Delete user account permanently
     */
    public function deleteAccount()
    {
        $user = Auth::user();
        
        // Logout user first
        Auth::logout();
        
        // Delete user account
        $user->delete();

        return redirect()->route('alumni.login')->with('success', 'Akun berhasil dihapus');
    }
}
