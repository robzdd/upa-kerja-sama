<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use App\Models\Artikel;
use App\Models\User;
use App\Models\Alumni;

class GuestController extends Controller
{
    public function index()
    {
        // Fetch latest 4 active jobs
        $latest_jobs = LowonganPekerjaan::with('mitra')
            ->where('status_aktif', true)
            ->where('status_aktif', true)
            // ->where('tanggal_selesai', '>=', now())
            ->latest()
            ->take(4)
            ->get();

        // Fetch all partners for the carousel
        $partners = MitraPerusahaan::select('id', 'nama_perusahaan', 'logo', 'sektor')->get();

        // Fetch latest 3 published articles
        $latest_articles = Artikel::with('user')
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // Counts for statistics
        $counts = [
            'jobs' => LowonganPekerjaan::where('status_aktif', true)->where('tanggal_selesai', '>=', now())->count(),
            'partners' => MitraPerusahaan::count(),
            'alumni' => Alumni::count(),
        ];

        return view('guest.home', compact('latest_jobs', 'partners', 'latest_articles', 'counts'));
    }
    public function about()
    {
        // Fetch document categories with their documents
        $categories = \App\Models\KategoriDokumen::with(['dokumen' => function($query) {
            $query->latest();
        }])->orderBy('urutan')->get();

        return view('alumni.tentang_kami', compact('categories'));
    }
}
