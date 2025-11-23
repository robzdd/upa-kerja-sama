<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan; // Added this line
use Illuminate\Http\Request;

class JobSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganPekerjaan::with(['mitra']) // Changed 'mitra' to ['mitra']
            ->where('status_aktif', true);

        // Search filters
        if ($request->filled('posisi')) {
            $query->where(function ($q) use ($request) { // Added a closure for OR conditions
                $q->where('judul', 'like', '%' . $request->posisi . '%')
                  ->orWhere('posisi', 'like', '%' . $request->posisi . '%');
            });
        }

        // Apply company filter if provided (assuming 'perusahaan' now refers to company ID)
        if ($request->filled('perusahaan')) {
            $query->where('mitra_id', $request->perusahaan); // Changed to filter by mitra_id
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }

        if ($request->filled('jenjang')) {
            $query->where('jenjang_pendidikan', $request->jenjang);
        }

        if ($request->filled('jenis_pekerjaan')) {
            $query->where('jenis_pekerjaan', $request->jenis_pekerjaan);
        }

        $lowongan = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('alumni.partials.job_list', compact('lowongan'))->render();
        }

        // Get stats
        $totalLowongan = LowonganPekerjaan::where('status_aktif', true)->count();
        $totalPelamar = LowonganPekerjaan::where('status_aktif', true)->sum('jumlah_pelamar');

        // Get distinct companies for dropdown
        $companies = MitraPerusahaan::whereHas('lowongan', function($q) {
            $q->where('status_aktif', true);
        })->orderBy('nama_perusahaan')->pluck('nama_perusahaan', 'id');

        // Get distinct locations for dropdown
        $locations = LowonganPekerjaan::where('status_aktif', true)
            ->whereNotNull('lokasi')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        // Get distinct job types
        $jobTypes = LowonganPekerjaan::where('status_aktif', true)
            ->whereNotNull('jenis_pekerjaan')
            ->distinct()
            ->orderBy('jenis_pekerjaan')
            ->pluck('jenis_pekerjaan');

        // Get distinct education levels
        $educationLevels = LowonganPekerjaan::where('status_aktif', true)
            ->whereNotNull('jenjang_pendidikan')
            ->distinct()
            ->orderBy('jenjang_pendidikan')
            ->pluck('jenjang_pendidikan');

        return view('alumni.cari_lowongan', compact('lowongan', 'totalLowongan', 'totalPelamar', 'companies', 'locations', 'jobTypes', 'educationLevels'));
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
