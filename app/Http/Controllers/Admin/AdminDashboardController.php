<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alumni;
use App\Models\MitraPerusahaan;
use App\Models\Mahasiswa;
use App\Models\Artikel;
use App\Models\LowonganPekerjaan;
use App\Models\Pelamar;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_alumni' => Alumni::count(),
            'total_mitra' => MitraPerusahaan::count(),
            'total_mahasiswa' => Mahasiswa::count(),
            'total_artikel' => Artikel::count(),
            'total_lowongan' => LowonganPekerjaan::count(),
            'total_pelamar' => Pelamar::count(),
        ];

        // Recent users
        $recent_users = User::with(['alumni', 'mitraPerusahaan', 'mahasiswa'])
            ->latest()
            ->take(5)
            ->get();

        $recent_artikel = Artikel::with('kategori', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_artikel'));
    }
}

