<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    /**
     * Menampilkan daftar semua pelamar untuk lowongan milik mitra
     */
    public function index(Request $request)
    {
        // Ambil mitra berdasarkan user yang login
        $userId = Auth::id();
        $mitra = MitraPerusahaan::where('user_id', $userId)->first();

        if (!$mitra) {
            return back()->with('error', 'Data mitra tidak ditemukan.');
        }

        // Ambil filter dari request
        $status = $request->get('status');
        $lowongan_id = $request->get('lowongan_id');
        $search = $request->get('search');

        // Query pelamar berdasarkan lowongan milik mitra
        $query = Pelamar::with([
            'user.alumni.riwayatPendidikan',
            'user.alumni.pengalamanKerja',
            'user.alumni.sertifikasi',
            'lowongan'
        ])
        ->whereHas('lowongan', function($q) use ($mitra) {
            $q->where('mitra_id', $mitra->id);
        });

        // Filter berdasarkan status
        if ($status) {
            $query->where('status', $status);
        }

        // Filter berdasarkan lowongan tertentu
        if ($lowongan_id) {
            $query->where('lowongan_id', $lowongan_id);
        }

        // Filter berdasarkan nama/email pelamar
        if ($search) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ambil data pelamar dengan pagination
        $pelamars = $query->orderBy('created_at', 'desc')->paginate(15);

        // Ambil semua lowongan milik mitra (untuk dropdown filter)
        $lowongans = LowonganPekerjaan::where('mitra_id', $mitra->id)
            ->orderBy('judul')
            ->get();

        // Statistik jumlah pelamar berdasarkan status
        $stats = [
            'total' => Pelamar::whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))->count(),
            'pending' => Pelamar::whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))->where('status', 'pending')->count(),
            'diterima' => Pelamar::whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))->where('status', 'diterima')->count(),
            'ditolak' => Pelamar::whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))->where('status', 'ditolak')->count(),
        ];

        return view('mitra.pelamar.index', compact('pelamars', 'lowongans', 'stats'));
    }

    /**
     * Menampilkan detail pelamar
     */
    public function show($id)
    {
        $userId = Auth::id();
        $mitra = MitraPerusahaan::where('user_id', $userId)->first();

        if (!$mitra) {
            abort(403, 'Data mitra tidak ditemukan.');
        }

        $pelamar = Pelamar::with([
            'user.alumni.riwayatPendidikan',
            'user.alumni.pengalamanKerja',
            'user.alumni.sertifikasi',
            'user.alumni.dokumenPendukung',
            'lowongan'
        ])
        ->whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))
        ->findOrFail($id);

        $alumni = $pelamar->user->alumni;

        return view('mitra.pelamar.show', compact('pelamar', 'alumni'));
    }

    /**
     * Update status pelamar
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
            'catatan' => 'nullable|string|max:500',
        ]);

        $mitra = MitraPerusahaan::where('user_id', Auth::id())->firstOrFail();

        $pelamar = Pelamar::whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))
            ->findOrFail($id);

        $pelamar->update(['status' => $request->status]);

        $statusText = [
            'pending' => 'dikembalikan ke status menunggu',
            'diterima' => 'diterima',
            'ditolak' => 'ditolak',
        ];

        return redirect()->back()->with('success', "Pelamar berhasil {$statusText[$request->status]}!");
    }

    /**
     * Bulk update status pelamar
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'pelamar_ids' => 'required|array',
            'pelamar_ids.*' => 'exists:pelamars,id',
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $mitra = MitraPerusahaan::where('user_id', Auth::id())->firstOrFail();

        Pelamar::whereIn('id', $request->pelamar_ids)
            ->whereHas('lowongan', fn($q) => $q->where('mitra_id', $mitra->id))
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui!');
    }
}
