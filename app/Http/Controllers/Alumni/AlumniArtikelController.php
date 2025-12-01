<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class AlumniArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $featured = Artikel::with(['user', 'kategori'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $query = Artikel::with(['user', 'kategori'])
            ->where('status', 'published');
            
        // Exclude featured articles from main list
        if ($featured->count() > 0) {
            $query->whereNotIn('id', $featured->pluck('id'));
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Filter by Category
        if ($request->has('category')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $artikels = $query->latest()->paginate(9);

        return view('alumni.artikel_page', compact('artikels', 'featured'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $artikel = Artikel::with(['user', 'kategori'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Related articles
        $related = Artikel::with(['user', 'kategori'])
            ->where('kategori_id', $artikel->kategori_id)
            ->where('id', '!=', $artikel->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        return view('alumni.artikel_detail', compact('artikel', 'related'));
    }
}
