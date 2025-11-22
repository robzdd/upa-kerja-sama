<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alumni;
use App\Models\MitraPerusahaan;

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

            'total_artikel' => Artikel::count(),
            'total_lowongan' => LowonganPekerjaan::count(),
            'total_pelamar' => Pelamar::count(),
        ];

        // Recent users
        $recent_users = User::with(['alumni', 'mitraPerusahaan'])
            ->latest()
            ->take(5)
            ->get();

        $recent_artikel = Artikel::with('kategori', 'user')
            ->latest()
            ->take(5)
            ->get();

        // Chart Data: User Growth (Last 6 Months)
        $userGrowth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [];
        $userCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthNum = $date->month;
            $months[] = $date->format('M');
            $userCounts[] = $userGrowth[$monthNum] ?? 0;
        }

        // Chart Data: Articles by Category
        $articleCategories = \App\Models\KategoriArtikel::withCount('artikel')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->nama,
                    'count' => $category->artikel_count
                ];
            });

        return view('admin.dashboard', compact(
            'stats', 
            'recent_users', 
            'recent_artikel',
            'months',
            'userCounts',
            'articleCategories'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Search Users
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->take(3)
            ->get()
            ->map(function($user) {
                return [
                    'type' => 'User',
                    'title' => $user->name,
                    'subtitle' => $user->email,
                    'url' => route('admin.users.edit', $user->id),
                    'icon' => 'user'
                ];
            });

        // Search Articles
        $articles = Artikel::where('judul', 'like', "%{$query}%")
            ->take(3)
            ->get()
            ->map(function($article) {
                return [
                    'type' => 'Artikel',
                    'title' => $article->judul,
                    'subtitle' => $article->kategori->nama ?? 'Uncategorized',
                    'url' => route('admin.artikel.show', $article->id), // Assuming show route exists, otherwise edit
                    'icon' => 'document-text'
                ];
            });

        // Search Lowongan (if model exists and has route)
        // Assuming LowonganPekerjaan model and route
        $lowongan = LowonganPekerjaan::where('judul', 'like', "%{$query}%")
            ->take(3)
            ->get()
            ->map(function($job) {
                return [
                    'type' => 'Lowongan',
                    'title' => $job->judul,
                    'subtitle' => $job->mitraPerusahaan->nama_perusahaan ?? 'Unknown Company',
                    'url' => '#', // Replace with actual route
                    'icon' => 'briefcase'
                ];
            });

        return response()->json([
            ...$users,
            ...$articles,
            ...$lowongan
        ]);
    }
}

