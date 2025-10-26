<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        $dokumen = $alumni->dokumenPendukung;

        return view('alumni.documents.index', compact('alumni', 'dokumen'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'tipe_dokumen' => 'required|in:cv,ktp,ijazah,transkrip,sertifikat,portofolio,surat_rekomendasi,ktm',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // 10MB max
        ]);

        $user = Auth::user();
        $alumni = $user->alumni;

        // Handle file upload
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents/alumni/' . $alumni->id, $fileName, 'public');

        // Create document record
        DokumenPendukung::create([
            'alumni_id' => $alumni->id,
            'tipe_dokumen' => $request->tipe_dokumen,
            'nama_dokumen' => $file->getClientOriginalName(),
            'path_file' => $filePath,
            'ukuran_file' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function download($id)
    {
        $user = Auth::user();
        $dokumen = DokumenPendukung::where('id', $id)
            ->where('alumni_id', $user->alumni->id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($dokumen->path_file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }

        return Storage::disk('public')->download($dokumen->path_file, $dokumen->nama_dokumen);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $dokumen = DokumenPendukung::where('id', $id)
            ->where('alumni_id', $user->alumni->id)
            ->firstOrFail();

        // Delete file from storage
        if (Storage::disk('public')->exists($dokumen->path_file)) {
            Storage::disk('public')->delete($dokumen->path_file);
        }

        // Delete record
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }

    public function view($id)
    {
        $user = Auth::user();
        $dokumen = DokumenPendukung::where('id', $id)
            ->where('alumni_id', $user->alumni->id)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($dokumen->path_file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }

        $filePath = Storage::disk('public')->path($dokumen->path_file);
        $fileContent = file_get_contents($filePath);
        $mimeType = Storage::disk('public')->mimeType($dokumen->path_file);

        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $dokumen->nama_dokumen . '"');
    }
}
