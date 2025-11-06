<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of articles
     */
    public function index()
    {
        $artikels = Artikel::with(['kategori', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        $kategoris = KategoriArtikel::all();
        return view('admin.artikel.create', compact('kategoris'));
    }

    /**
     * Store a newly created article
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_artikels,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'konten' => $request->konten,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel/thumbnails', 'public');
        }

        Artikel::create($data);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Display the specified article
     */
    public function show($id)
    {
        $artikel = Artikel::with(['kategori', 'user'])->findOrFail($id);
        return view('admin.artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified article
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategoris = KategoriArtikel::all();
        return view('admin.artikel.edit', compact('artikel', 'kategoris'));
    }

    /**
     * Update the specified article
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_artikels,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'konten' => $request->konten,
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($artikel->thumbnail) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel/thumbnails', 'public');
        }

        $artikel->update($data);

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified article
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Delete thumbnail
        if ($artikel->thumbnail) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }

        $artikel->delete();

        return redirect()
            ->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}

