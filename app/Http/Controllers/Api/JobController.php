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
        $query = LowonganPekerjaan::with('mitra')
            ->where('status_aktif', true)
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan keyword
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhereHas('mitra', function ($subQ) use ($search) {
                      $subQ->where('nama_perusahaan', 'like', "%{$search}%");
                  });
            });
        }

        $jobs = $query->get();

        return response()->json([
            'success' => true,
            'data' => $jobs,
            'message' => 'Data lowongan berhasil diambil'
        ]);
    }

    /**
     * Get job detail
     */
    public function show($id)
    {
        $job = LowonganPekerjaan::with('mitra')
            ->where('id', $id)
            ->where('status_aktif', true)
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $job,
            'message' => 'Detail lowongan berhasil diambil'
        ]);
    }

    /**
     * Get jobs for currently authenticated mitra (by simple token)
     */
    public function my(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak ditemukan',
            ], 401);
        }

        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0] ?? null;

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid',
            ], 401);
        }

        // Find mitra by user id and list its jobs only
        $mitra = \App\Models\MitraPerusahaan::where('user_id', $userId)->first();
        if (!$mitra) {
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Tidak ada lowongan untuk akun ini'
            ]);
        }

        $jobs = LowonganPekerjaan::with('mitra')
            ->where('mitra_id', $mitra->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $jobs,
            'message' => 'Data lowongan mitra berhasil diambil'
        ]);
    }
}
