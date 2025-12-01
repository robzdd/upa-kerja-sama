<?php

namespace App\Http\Controllers\Alumni;

use Illuminate\Http\Request;
use App\Models\RiwayatPendidikan;
use App\Models\PengalamanKerjaOrganisasi;
use App\Models\PengalamanSertifikasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AlumniAkademikController extends Controller
{
    public function index()
    {
        $alumni = Auth::user()->alumni;
        $pendidikan = RiwayatPendidikan::where('alumni_id', $alumni->id)->get();
        $pengalaman = PengalamanKerjaOrganisasi::where('alumni_id', $alumni->id)->get();
        $sertifikasi = PengalamanSertifikasi::where('alumni_id', $alumni->id)->get();

        return view('alumni.data-akademik', compact('pendidikan', 'pengalaman', 'sertifikasi'));
    }

    public function storePendidikan(Request $request)
    {
        $request->validate([
            'jenjang' => 'required',
            'institusi' => 'required',
        ]);

        RiwayatPendidikan::create([
            'alumni_id' => Auth::user()->alumni->id,
            'jenjang' => $request->jenjang,
            'institusi' => $request->institusi,
            'jurusan' => $request->jurusan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
            'ipk' => $request->ipk,
        ]);

        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan.');
    }

    public function storePengalaman(Request $request)
    {
        $request->validate([
            'nama_institusi' => 'required',
            'jenis' => 'required',
        ]);

        PengalamanKerjaOrganisasi::create([
            'alumni_id' => Auth::user()->alumni->id,
            'nama_institusi' => $request->nama_institusi,
            'jabatan' => $request->jabatan,
            'jenis' => $request->jenis,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function storeSertifikasi(Request $request)
    {
        $request->validate([
            'nama_sertifikasi' => 'required',
            'penerbit' => 'required',
        ]);

        PengalamanSertifikasi::create([
            'alumni_id' => Auth::user()->alumni->id,
            'nama_sertifikasi' => $request->nama_sertifikasi,
            'penerbit' => $request->penerbit,
            'tanggal_diperoleh' => $request->tanggal_diperoleh,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'link_sertifikat' => $request->link_sertifikat,
        ]);

        return back()->with('success', 'Sertifikasi berhasil ditambahkan.');
    }
}
