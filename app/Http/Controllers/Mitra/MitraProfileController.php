<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class MitraProfileController extends Controller
{
    public function index()
    {
        $mitra = auth()->guard('mitra')->user()->mitraPerusahaan;
        return view('mitra.profile.index', compact('mitra'));
    }

    public function update(Request $request)
    {
        $user = auth()->guard('mitra')->user();
        $mitra = $user->mitraPerusahaan;

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sektor' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'tautan' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama_perusahaan', 'sektor', 'kontak', 'tautan', 'deskripsi', 'alamat']);

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete($mitra->logo);
            }
            $data['logo'] = $request->file('logo')->store('mitra-logos', 'public');
        }

        $mitra->update($data);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    public function settings()
    {
        return view('mitra.profile.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password:mitra',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->guard('mitra')->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->guard('mitra')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Informasi akun berhasil diperbarui.');
    }
}
