<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenPublikController extends Controller
{
    /**
     * Display a listing of dokumen
     */
    public function index(Request $request)
    {
        $query = DokumenPublik::with(['kategori', 'user'])->latest();

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_dokumen_id', $request->kategori);
        }

        $dokumens = $query->paginate(15);
        $kategoris = KategoriDokumen::ordered()->get();

        return view('admin.dokumen.index', compact('dokumens', 'kategoris'));
    }

    /**
     * Show the form for creating a new dokumen
     */
    public function create()
    {
        $kategoris = KategoriDokumen::ordered()->get();
        return view('admin.dokumen.create', compact('kategoris'));
    }

    /**
     * Store a newly created dokumen
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_dokumen_id' => 'required|exists:kategori_dokumen,id',
            'file' => 'required|file|mimes:pdf,xls,xlsx|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::uuid() . '.' . $extension;
        $filePath = $file->storeAs('dokumen', $fileName, 'public');

        DokumenPublik::create([
            'user_id' => Auth::id(),
            'kategori_dokumen_id' => $request->kategori_dokumen_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'file_type' => strtoupper($extension),
            'file_size' => $file->getSize(),
            'download_count' => 0,
        ]);

        return redirect()
            ->route('admin.dokumen-publik.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }

    /**
     * Show the form for editing the specified dokumen
     */
    public function edit($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);
        $kategoris = KategoriDokumen::ordered()->get();
        return view('admin.dokumen.edit', compact('dokumen', 'kategoris'));
    }

    /**
     * Update the specified dokumen
     */
    public function update(Request $request, $id)
    {
        $dokumen = DokumenPublik::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_dokumen_id' => 'required|exists:kategori_dokumen,id',
            'file' => 'nullable|file|mimes:pdf,xls,xlsx|max:10240',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_dokumen_id' => $request->kategori_dokumen_id,
        ];

        // If new file uploaded, replace old file
        if ($request->hasFile('file')) {
            // Delete old file
            if ($dokumen->file_path) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $extension;
            $filePath = $file->storeAs('dokumen', $fileName, 'public');

            $data['file_path'] = $filePath;
            $data['file_type'] = strtoupper($extension);
            $data['file_size'] = $file->getSize();
        }

        $dokumen->update($data);

        return redirect()
            ->route('admin.dokumen-publik.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified dokumen
     */
    public function destroy($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);

        // Delete file from storage
        if ($dokumen->file_path) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()
            ->route('admin.dokumen-publik.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Download dokumen
     */
    public function download($id)
    {
        $dokumen = DokumenPublik::findOrFail($id);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($dokumen->file_path, $dokumen->judul . '.' . strtolower($dokumen->file_type));
    }
}
