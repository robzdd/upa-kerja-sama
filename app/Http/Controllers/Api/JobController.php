<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;

class JobController extends Controller
{
    /**
     * Get list of job vacancies
     */
    public function index(Request $request)
    {
        $query = LowonganPekerjaan::with('mitraPerusahaan')
            ->where('status_aktif', true)
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan keyword
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhereHas('mitraPerusahaan', function ($subQ) use ($search) {
                      $subQ->where('nama_perusahaan', 'like', "%{$search}%");
                  });
            });
        }

        $jobs = $query->get();

        return response()->json($jobs);
    }

    /**
     * Get job detail
     */
    public function show($id)
    {
        $job = LowonganPekerjaan::with('mitraPerusahaan')
            ->where('id', $id)
            ->where('status_aktif', true)
            ->first();

        if (!$job) {
            return response()->json([
                'message' => 'Lowongan tidak ditemukan',
            ], 404);
        }

        return response()->json($job);
    }
}
