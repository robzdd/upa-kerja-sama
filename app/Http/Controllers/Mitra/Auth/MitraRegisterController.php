<?php

namespace App\Http\Controllers\Mitra\Auth;

use App\Http\Controllers\Controller;
use App\Models\MitraRegistrationRequest;
use App\Mail\MitraRegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MitraRegisterController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('auth.mitra_register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|email|unique:mitra_registration_requests,email|unique:users,email',
            'telepon' => 'required|string|max:50',
            'alamat' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            'terms' => 'required|accepted',
        ], [
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain atau hubungi admin jika Anda sudah mendaftar sebelumnya.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        // Handle file upload
        $dokumenPath = null;
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $dokumenPath = $file->storeAs('mitra-documents', $fileName, 'public');
        }

        // Create registration request
        $registrationRequest = MitraRegistrationRequest::create([
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'email' => $validated['email'],
            'telepon' => $validated['telepon'],
            'alamat' => $validated['alamat'],
            'bidang_usaha' => $validated['bidang_usaha'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'dokumen_path' => $dokumenPath,
            'status' => MitraRegistrationRequest::STATUS_PENDING,
        ]);

        // Send email notification to admin
        try {
            // Get admin email from config or use default
            $adminEmail = config('mail.admin_email', 'admin@polindra.ac.id');
            Mail::to($adminEmail)->send(new MitraRegistrationNotification($registrationRequest));
        } catch (\Exception $e) {
            // Log error but don't fail the registration
            \Log::error('Failed to send mitra registration email: ' . $e->getMessage());
        }

        return redirect()
            ->route('mitra.register')
            ->with('success', 'Pendaftaran berhasil dikirim! Kami akan meninjau dan menghubungi Anda melalui email dalam 1-3 hari kerja.');
    }
}
