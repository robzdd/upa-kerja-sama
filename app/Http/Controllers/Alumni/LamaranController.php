<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Pelamar;
use App\Models\LowonganPekerjaan;
use App\Models\Alumni;
use Illuminate\Support\Facades\Log;

class LamaranController extends Controller
{
    public function index()
    {
        return redirect()->route('alumni.cari_lowongan');
    }
    
    public function details($id)
    {
        $lowongan = LowonganPekerjaan::with('mitra')->findOrFail($id);
        
        return response()->json($lowongan);
    }
    
    public function show($id)
    {
        $lowongan = LowonganPekerjaan::with('mitra')->findOrFail($id);
        
        return view('alumni.lowongan_detail', compact('lowongan'));
    }
    
    public function showApplyForm($lowonganId)
    {
        $lowongan = LowonganPekerjaan::with('mitra')->findOrFail($lowonganId);
        $user = Auth::user();
        $alumni = $user->alumni;
        
        // Check if already applied
        $hasApplied = Pelamar::where('user_id', $user->id)
            ->where('lowongan_id', $lowonganId)
            ->exists();
        
        if ($hasApplied) {
            return redirect()->back()->with('error', 'Anda sudah melamar pada lowongan ini');
        }
        
        // Check if profile is complete
        $isProfileComplete = $this->checkProfileComplete($alumni);

         $applications = Pelamar::with(['lowongan.mitra'])
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('alumni.apply', compact('lowongan', 'alumni', 'isProfileComplete', 'applications'));
    }
    
    public function apply(Request $request, $lowonganId)
    {
        $request->validate([
            'pesan_lamaran' => 'required|string|min:50|max:1000',
            'agree_terms' => 'required|accepted',
        ], [
            'pesan_lamaran.required' => 'Pesan lamaran wajib diisi',
            'pesan_lamaran.min' => 'Pesan lamaran minimal 50 karakter',
            'pesan_lamaran.max' => 'Pesan lamaran maksimal 1000 karakter',
            'agree_terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);
        
        $user = Auth::user();
        $lowongan = LowonganPekerjaan::findOrFail($lowonganId);
        
        // Check if already applied
        $hasApplied = Pelamar::where('user_id', $user->id)
            ->where('lowongan_id', $lowonganId)
            ->exists();
        
        if ($hasApplied) {
            return redirect()->back()->with('error', 'Anda sudah melamar pada lowongan ini');
        }
        
        // Check if profile is complete
        $alumni = $user->alumni;
        if (!$this->checkProfileComplete($alumni)) {
            return redirect()->back()->with('error', 'Lengkapi profil Anda terlebih dahulu sebelum melamar');
        }
        
        // Create application
        $pelamar = Pelamar::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'lowongan_id' => $lowonganId,
            'status' => 'pending',
            'pesan_lamaran' => $request->pesan_lamaran,
        ]);
        
        // Update jumlah pelamar di lowongan
        $lowongan->increment('jumlah_pelamar');

        // Send Notification to Mitra
        if ($lowongan->mitra && $lowongan->mitra->user) {
            $lowongan->mitra->user->notify(new \App\Notifications\NewApplicantNotification($pelamar));
        }
        
        return redirect()->route('alumni.applications')->with('success', 'Lamaran berhasil dikirim!');
    }
    
    public function myApplications()
    {
        $user = Auth::user();
        
        $applications = Pelamar::with(['lowongan.mitra'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('alumni.applications.index', compact('applications'));
    }
    
    public function cancelApplication($id)
    {
        $user = Auth::user();
        
        $pelamar = Pelamar::where('id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();
        
        // Decrement jumlah pelamar
        $pelamar->lowongan->decrement('jumlah_pelamar');
        
        // Delete application
        $pelamar->delete();
        
        return redirect()->back()->with('success', 'Lamaran berhasil dibatalkan');
    }
    
   private function checkProfileComplete($alumni)
    {

        if (!$alumni) {
            Log::info("Alumni tidak ditemukan");
            return false;
        }

        $checks = [
            'name' => $alumni->user->name ?? null,
            'email' => $alumni->user->email ?? null,
            'no_hp' => $alumni->no_hp,
            'tempat_lahir' => $alumni->tempat_lahir,
            'tanggal_lahir' => $alumni->tanggal_lahir,
            'jenis_kelamin' => $alumni->jenis_kelamin,
            'alamat' => $alumni->alamat,
        ];

        foreach ($checks as $key => $value) {
            Log::info("Check $key: " . ($value ? 'Ada' : 'KOSONG'));
            if (empty($value)) {
                return false;
            }
        }

            if (!$alumni) return false;

            // Field minimal yang BENAR-BENAR wajib
            $requiredFields = [
                'name' => $alumni->user->name ?? null,
                'email' => $alumni->user->email ?? null,
                'no_hp' => $alumni->no_hp,
            ];

            // Cek field wajib
            foreach ($requiredFields as $key => $value) {
                if (empty($value)) {
                    Log::info("Field kosong: $key"); // Untuk debugging
                    return false;
                }
            }


            // OPSIONAL: Cek minimal ada SATU data tambahan
            // Hapus bagian ini jika tidak perlu
            $hasEducation = $alumni->riwayatPendidikan()->exists();
            $hasWork = $alumni->pengalamanKerja()->exists();
            $hasCV = $alumni->dokumenPendukung()
                ->where('tipe_dokumen', 'cv')
                ->exists();

            if (!($hasEducation || $hasWork || $hasCV)) {
                Log::info("Tidak ada data pendukung"); // Untuk debugging
                return false;
            }

            return true;
    }
}