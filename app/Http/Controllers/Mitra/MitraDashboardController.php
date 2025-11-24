<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;

class MitraDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->guard('mitra')->user();
        
        // Ensure user has mitra profile
        if (!$user->mitraPerusahaan) {
            return redirect()->route('mitra.profile.index')->with('warning', 'Silakan lengkapi profil perusahaan Anda terlebih dahulu.');
        }

        $mitraId = $user->mitraPerusahaan->id;

        // Statistics
        $stats = [
            'lowongan_aktif' => \App\Models\LowonganPekerjaan::where('mitra_id', $mitraId)
                ->where('status_aktif', true)
                ->count(),
            'total_pelamar' => \App\Models\Pelamar::whereHas('lowongan', function($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })->count(),
            'pelamar_baru' => \App\Models\Pelamar::whereHas('lowongan', function($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })->where('status', 'pending')->count(),
            'pelamar_diterima' => \App\Models\Pelamar::whereHas('lowongan', function($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })->where('status', 'diterima')->count(),
        ];

        // Recent Applicants
        $recentPelamars = \App\Models\Pelamar::with(['user', 'lowongan'])
            ->whereHas('lowongan', function($q) use ($mitraId) {
                $q->where('mitra_id', $mitraId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('mitra.dashboard', compact('stats', 'recentPelamars'));
    }
}
