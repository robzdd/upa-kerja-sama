<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganPekerjaan::with('mitra')
            ->where('status_aktif', true);

        // Search filters
        if ($request->filled('posisi')) {
            $query->where('judul', 'like', '%' . $request->posisi . '%')
                  ->orWhere('posisi', 'like', '%' . $request->posisi . '%');
        }

        if ($request->filled('perusahaan')) {
            $query->whereHas('mitra', function($q) use ($request) {
                $q->where('nama_perusahaan', 'like', '%' . $request->perusahaan . '%');
            });
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->filled('jenjang')) {
            $query->where('jenjang_pendidikan', $request->jenjang);
        }

        if ($request->filled('jenis_pekerjaan')) {
            $query->where('jenis_pekerjaan', $request->jenis_pekerjaan);
        }

        $lowongan = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get stats
    $totalLowongan = LowonganPekerjaan::where('status_aktif', true)->count();
    $totalPelamar = LowonganPekerjaan::where('status_aktif', true)->sum('jumlah_pelamar');

        return view('alumni.cari_lowongan', compact('lowongan', 'totalLowongan', 'totalPelamar'));
    }

    public function show(LowonganPekerjaan $lowongan)
    {
        $lowongan->load('mitra');
        return view('alumni.detail_lowongan', compact('lowongan'));
    }

    public function getJobDetails($id)
    {
        $job = LowonganPekerjaan::with('mitra')->findOrFail($id);
        return response()->json($job);
    }
}
