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
        ]);

        $mitra = MitraPerusahaan::where('user_id', Auth::id())->first();

        $lowongan = LowonganPekerjaan::create([
            'mitra_id' => $mitra->id,
            'judul' => $request->judul,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'prodi_diizinkan' => $request->prodi_diizinkan ?? [],
            'persyaratan_dokumen' => $request->persyaratan_dokumen ?? [],
            'rincian_lowongan' => $request->rincian_lowongan,
            'tanggal_penerimaan_lamaran' => $request->tanggal_penerimaan_lamaran,
            'tanggal_pengumuman' => $request->tanggal_pengumuman,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'pengalaman_minimal' => $request->pengalaman_minimal,
            'skill_required' => $request->skill_required ?? [],
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
        ]);

        $lowongan->update($request->all());

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
