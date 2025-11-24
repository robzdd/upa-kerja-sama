<?php

namespace App\Http\Controllers;

use App\Models\DokumenPublik;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPublikController extends Controller
{
    /**
     * Display a listing of kategori dokumen (public)
     */
    public function index()
    {
        $kategoris = KategoriDokumen::withCount('dokumen')
            ->ordered()
            ->get();

        return view('dokumen.index', compact('kategoris'));
    }

    /**
     * Display dokumen by kategori (public)
     */
    public function category($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        $dokumens = DokumenPublik::where('kategori_dokumen_id', $id)
            ->latest()
            ->paginate(12);

        return view('dokumen.category', compact('kategori', 'dokumens'));
    }

    /**
     * Download dokumen (public)
     */
    public function download($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Increment download counter
        $dokumen->incrementDownload();

        return Storage::disk('public')->download(
            $dokumen->file_path,
            $dokumen->judul . '.' . strtolower($dokumen->file_type)
        );
    }
}
