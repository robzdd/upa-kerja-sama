<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LowonganPekerjaan;
use App\Models\User;

class SavedJobController extends Controller
{
    protected function getAuthUser(Request $request): ?User
    {
        $token = $request->bearerToken();
        if (!$token) return null;
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        return $userId ? User::find($userId) : null;
    }

    public function index(Request $request)
    {
        $user = $this->getAuthUser($request);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);

        $rows = DB::table('pelamars as p')
            ->join('lowongan_pekerjaans as l', 'l.id', '=', 'p.lowongan_id')
            ->join('mitra_perusahaan as m', 'm.id', '=', 'l.mitra_id')
            ->select('p.*',
                'l.id as job_id','l.judul','l.deskripsi','l.lokasi','l.gaji_min','l.gaji_max','l.jenis_pekerjaan','l.jenjang_pendidikan','l.rincian_lowongan','l.status_aktif',
                'm.id as company_id','m.nama_perusahaan','m.sektor','m.tautan','m.kontak')
            ->where('p.user_id', $user->id)
            ->where('p.status', 'tersimpan')
            ->orderBy('p.created_at', 'desc')
            ->get();

        $data = $rows->map(function($r){
            return [
                'id' => $r->id,
                'saved_at' => $r->created_at,
                'lowongan' => [
                    'id' => $r->job_id,
                    'judul' => $r->judul,
                    'deskripsi' => $r->deskripsi,
                    'lokasi' => $r->lokasi,
                    'gaji_min' => $r->gaji_min,
                    'gaji_max' => $r->gaji_max,
                    'jenis_pekerjaan' => $r->jenis_pekerjaan,
                    'jenjang_pendidikan' => $r->jenjang_pendidikan,
                    'rincian_lowongan' => $r->rincian_lowongan,
                    'status_aktif' => (bool) $r->status_aktif,
                    'mitra' => [
                        'id' => $r->company_id,
                        'nama_perusahaan' => $r->nama_perusahaan,
                        'sektor' => $r->sektor,
                        'tautan' => $r->tautan,
                        'kontak' => $r->kontak,
                    ],
                ],
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request, $jobId)
    {
        $user = $this->getAuthUser($request);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);

        $job = LowonganPekerjaan::find($jobId);
        if (!$job) return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan'], 404);

        // If there is already a non-'tersimpan' application, do NOT overwrite it.
        $applied = DB::table('pelamars')
            ->where('user_id', $user->id)
            ->where('lowongan_id', $job->id)
            ->where('status', '!=', 'tersimpan')
            ->exists();

        // Ensure a 'tersimpan' record exists separately
        $savedRow = DB::table('pelamars')
            ->where('user_id', $user->id)
            ->where('lowongan_id', $job->id)
            ->where('status', 'tersimpan')
            ->first();

        if ($savedRow) {
            return response()->json(['success' => true, 'message' => 'Sudah tersimpan', 'data' => $savedRow]);
        }

        $id = (string) \Str::uuid();
        DB::table('pelamars')->insert([
            'id' => $id,
            'user_id' => $user->id,
            'lowongan_id' => $job->id,
            'status' => 'tersimpan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $saved = DB::table('pelamars')->where('id', $id)->first();

        return response()->json(['success' => true, 'message' => $applied ? 'Ditandai tersimpan (lamaran tetap ada)' : 'Lowongan disimpan', 'data' => $saved]);
    }

    public function destroy(Request $request, $jobId)
    {
        $user = $this->getAuthUser($request);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);

        $deleted = DB::table('pelamars')
            ->where('user_id', $user->id)
            ->where('lowongan_id', $jobId)
            ->where('status', 'tersimpan')
            ->delete();

        return response()->json(['success' => true, 'message' => $deleted ? 'Dihapus dari tersimpan' : 'Tidak ada data untuk dihapus']);
    }
}


