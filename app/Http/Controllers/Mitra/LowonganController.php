<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    public function index()
    {
        $mitra = MitraPerusahaan::where('user_id', Auth::id())->first();
        $lowongan = LowonganPekerjaan::where('mitra_id', $mitra->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mitra.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        return view('mitra.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'jenis_pekerjaan' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'rincian_lowongan' => 'required|string',
            'tanggal_penerimaan_lamaran' => 'required|date',
            'tanggal_pengumuman' => 'required|date',
            'gaji_min' => 'nullable',
            'gaji_max' => 'nullable',
            'pengalaman_minimal' => 'nullable|string',
            'jurusan_diizinkan' => 'nullable|array',
            'persyaratan_dokumen' => 'nullable|array',
            'skill_required' => 'nullable|array',
        ]);

        $mitra = MitraPerusahaan::where('user_id', Auth::id())->first();

        $lowongan = LowonganPekerjaan::create([
            'mitra_id' => $mitra->id,
            'judul' => $request->string('judul')->toString(),
            'posisi' => $request->string('posisi')->toString(),
            'deskripsi' => $request->string('deskripsi')->toString(),
            'lokasi' => $request->string('lokasi')->toString(),
            'jenis_pekerjaan' => $request->string('jenis_pekerjaan')->toString(),
            'jenjang_pendidikan' => $request->string('jenjang_pendidikan')->toString(),
            'jurusan_diizinkan' => $request->input('jurusan_diizinkan', []),
            'persyaratan_dokumen' => $request->input('persyaratan_dokumen', []),
            'rincian_lowongan' => $request->string('rincian_lowongan')->toString(),
            'tanggal_penerimaan_lamaran' => $request->date('tanggal_penerimaan_lamaran'),
            'tanggal_pengumuman' => $request->date('tanggal_pengumuman'),
            'gaji_min' => $request->input('gaji_min'),
            'gaji_max' => $request->input('gaji_max'),
            'pengalaman_minimal' => $request->input('pengalaman_minimal'),
            'skill_required' => $request->input('skill_required', []),
            'status_aktif' => true,
        ]);

        return redirect()->route('mitra.lowongan.index')
            ->with('success', 'Lowongan berhasil dibuat!');
    }

    public function show(LowonganPekerjaan $lowongan)
    {
        return view('mitra.lowongan.show', compact('lowongan'));
    }

    public function edit(LowonganPekerjaan $lowongan)
    {
        return view('mitra.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, LowonganPekerjaan $lowongan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'jenis_pekerjaan' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'rincian_lowongan' => 'required|string',
            'tanggal_penerimaan_lamaran' => 'required|date',
            'tanggal_pengumuman' => 'required|date',
            'gaji_min' => 'nullable',
            'gaji_max' => 'nullable',
            'pengalaman_minimal' => 'nullable|string',
            'jurusan_diizinkan' => 'nullable|array',
            'persyaratan_dokumen' => 'nullable|array',
            'skill_required' => 'nullable|array',
        ]);

        $lowongan->update([
            'judul' => $request->string('judul')->toString(),
            'posisi' => $request->string('posisi')->toString(),
            'deskripsi' => $request->string('deskripsi')->toString(),
            'lokasi' => $request->string('lokasi')->toString(),
            'jenis_pekerjaan' => $request->string('jenis_pekerjaan')->toString(),
            'jenjang_pendidikan' => $request->string('jenjang_pendidikan')->toString(),
            'jurusan_diizinkan' => $request->input('jurusan_diizinkan', []),
            'persyaratan_dokumen' => $request->input('persyaratan_dokumen', []),
            'rincian_lowongan' => $request->string('rincian_lowongan')->toString(),
            'tanggal_penerimaan_lamaran' => $request->date('tanggal_penerimaan_lamaran'),
            'tanggal_pengumuman' => $request->date('tanggal_pengumuman'),
            'gaji_min' => $request->input('gaji_min'),
            'gaji_max' => $request->input('gaji_max'),
            'pengalaman_minimal' => $request->input('pengalaman_minimal'),
            'skill_required' => $request->input('skill_required', []),
        ]);

        return redirect()->route('mitra.lowongan.index')
            ->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(LowonganPekerjaan $lowongan)
    {
        $lowongan->delete();

        return redirect()->route('mitra.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }
}
