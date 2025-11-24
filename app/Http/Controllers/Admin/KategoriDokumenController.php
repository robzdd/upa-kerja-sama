<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class KategoriDokumenController extends Controller
{
    /**
     * Display a listing of kategori dokumen
     */
    public function index()
    {
        $kategoris = KategoriDokumen::withCount('dokumen')
            ->ordered()
            ->get();

        return view('admin.kategori-dokumen.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new kategori
     */
    public function create()
    {
        return view('admin.kategori-dokumen.create');
    }

    /**
     * Store a newly created kategori
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:50',
            'urutan' => 'required|integer|min:0',
        ]);

        KategoriDokumen::create($request->all());

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified kategori
     */
    public function edit($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        return view('admin.kategori-dokumen.edit', compact('kategori'));
    }

    /**
     * Update the specified kategori
     */
    public function update(Request $request, $id)
    {
        $kategori = KategoriDokumen::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'required|string|max:50',
            'urutan' => 'required|integer|min:0',
        ]);

        $kategori->update($request->all());

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified kategori
     */
    public function destroy($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);

        // Check if kategori has documents
        if ($kategori->dokumen()->count() > 0) {
            return redirect()
                ->route('admin.kategori-dokumen.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki dokumen.');
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil dihapus.');
    }
}
