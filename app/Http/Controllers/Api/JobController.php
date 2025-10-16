<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;

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
        $mitra = MitraPerusahaan::where('user_id', $userId)->first();
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

    /**
     * Create a job for the authenticated mitra
     */
    public function store(Request $request)
    {
        $token = $request->bearerToken();
        $decoded = $token ? base64_decode($token) : null;
        $parts = $decoded ? explode('|', $decoded) : [];
        $userId = $parts[0] ?? null;
        $mitra = $userId ? MitraPerusahaan::where('user_id', $userId)->first() : null;
        if (!$mitra) {
            return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'jenis_pekerjaan' => 'nullable|string|max:100',
            'jenjang_pendidikan' => 'nullable|string|max:100',
            'jurusan_diizinkan' => 'nullable|array',
            'persyaratan_dokumen' => 'nullable|array',
            'rincian_lowongan' => 'nullable|string',
            'gaji_min' => 'nullable|integer',
            'gaji_max' => 'nullable|integer',
            'pengalaman_minimal' => 'nullable|string|max:100',
            'skill_required' => 'nullable|array',
            'tanggal_penerimaan_lamaran' => 'nullable|date',
            'tanggal_pengumuman' => 'nullable|date',
            'status_aktif' => 'nullable|boolean',
        ]);

        $job = LowonganPekerjaan::create(array_merge($validated, [
            'mitra_id' => $mitra->id,
            'status_aktif' => $validated['status_aktif'] ?? true,
        ]));

        return response()->json(['success' => true, 'message' => 'Lowongan berhasil dibuat', 'data' => $job]);
    }

    /**
     * Delete a job owned by the authenticated mitra
     */
    public function destroy(Request $request, $id)
    {
        $token = $request->bearerToken();
        $decoded = $token ? base64_decode($token) : null;
        $parts = $decoded ? explode('|', $decoded) : [];
        $userId = $parts[0] ?? null;
        $mitra = $userId ? MitraPerusahaan::where('user_id', $userId)->first() : null;
        if (!$mitra) {
            return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);
        }

        $job = LowonganPekerjaan::where('id', $id)->where('mitra_id', $mitra->id)->first();
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan'], 404);
        }
        $job->delete();
        return response()->json(['success' => true, 'message' => 'Lowongan berhasil dihapus']);
    }

    /**
     * Toggle status aktif or set expired based on tanggal_selesai
     */
    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status_aktif' => 'nullable|boolean',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $job = LowonganPekerjaan::find($id);
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan'], 404);
        }

        if ($request->has('status_aktif')) {
            $job->status_aktif = (bool)$request->status_aktif;
        }
        if ($request->has('tanggal_selesai')) {
            $job->tanggal_selesai = $request->tanggal_selesai;
            // auto set inactive if already past
            if (now()->gt($job->tanggal_selesai)) {
                $job->status_aktif = false;
            }
        }
        $job->save();
        return response()->json(['success' => true, 'message' => 'Status lowongan diperbarui', 'data' => $job]);
    }
}
