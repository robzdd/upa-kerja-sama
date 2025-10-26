<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        // Hapus semua jejak lamaran/tersimpan agar tidak muncul di sisi alumni
        DB::table('pelamars')->where('lowongan_id', $job->id)->delete();
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

    /**
     * Apply to a job as the authenticated alumni (simple token auth)
     */
    public function apply(Request $request, $id)
    {
        $token = $request->bearerToken();
        if (!$token) return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $user = $userId ? User::find($userId) : null;
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);

        $job = LowonganPekerjaan::find($id);
        if (!$job || !$job->status_aktif) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak tersedia'], 404);
        }

        // Upsert into pelamars without dedicated model
        // Find any existing application for this job by this user
        $existingNonSaved = DB::table('pelamars')
            ->where('user_id', $user->id)
            ->where('lowongan_id', $job->id)
            ->where('status', '!=', 'tersimpan')
            ->first();
        if ($existingNonSaved) {
            // Already applied/tracked: keep status, but ensure not duplicate
            $application = $existingNonSaved;
        } else {
            // If there is a saved entry, we can either update it or create a separate application.
            $saved = DB::table('pelamars')
                ->where('user_id', $user->id)
                ->where('lowongan_id', $job->id)
                ->where('status', 'tersimpan')
                ->first();

            if ($saved) {
                DB::table('pelamars')->where('id', $saved->id)->update([
                    'status' => 'melamar',
                    'updated_at' => now(),
                ]);
                $application = DB::table('pelamars')->where('id', $saved->id)->first();
            } else {
                $id = (string) \Str::uuid();
                DB::table('pelamars')->insert([
                    'id' => $id,
                    'user_id' => $user->id,
                    'lowongan_id' => $job->id,
                    'status' => 'melamar',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $application = DB::table('pelamars')->where('id', $id)->first();
            }
        }

        // increment count (best-effort)
        $job->increment('jumlah_pelamar');

        return response()->json(['success' => true, 'message' => 'Lamaran terkirim', 'data' => $application]);
    }

    /**
     * List my applications by status tabs
     */
    public function myApplications(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $user = $userId ? User::find($userId) : null;
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak valid'], 401);

        $status = $request->query('status'); // melamar, lolos, interview, diterima, ditolak (bukan 'tersimpan')
        $query = DB::table('pelamars as p')
            ->join('lowongan_pekerjaans as l', 'l.id', '=', 'p.lowongan_id')
            ->join('mitra_perusahaan as m', 'm.id', '=', 'l.mitra_id')
            ->select('p.*',
                'l.id as job_id','l.judul','l.deskripsi','l.lokasi','l.gaji_min','l.gaji_max','l.jenis_pekerjaan','l.jenjang_pendidikan','l.rincian_lowongan',
                'm.id as company_id','m.nama_perusahaan','m.sektor','m.tautan','m.kontak')
            ->where('p.user_id', $user->id)
            ->whereNull('l.deleted_at')
            ->where('l.status_aktif', true)
            ->orderBy('p.created_at', 'desc');
        if ($status) {
            $query->where('p.status', $status);
        } else {
            // Default: exclude saved-only entries from "Lamaran Saya"
            $query->where('p.status', '!=', 'tersimpan');
        }
        $rows = $query->get();

        $apps = $rows->map(function($r){
            return [
                'id' => $r->id,
                'user_id' => $r->user_id,
                'lowongan_id' => $r->lowongan_id,
                'status' => $r->status,
                'created_at' => $r->created_at,
                'updated_at' => $r->updated_at,
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

        return response()->json(['success' => true, 'data' => $apps]);
    }

    /**
     * Mitra updates applicant status per job
     */
    public function updateApplicationStatus(Request $request, $applicationId)
    {
        $request->validate(['status' => 'required|in:melamar,lolos,interview,diterima,ditolak']);
        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        if (!$app) return response()->json(['success' => false, 'message' => 'Lamaran tidak ditemukan'], 404);
        DB::table('pelamars')->where('id', $applicationId)->update(['status' => $request->status, 'updated_at' => now()]);
        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        return response()->json(['success' => true, 'message' => 'Status lamaran diperbarui', 'data' => $app]);
    }

    /**
     * Mitra: list applicants for a specific job owned by the mitra, with CV info
     */
    public function applicantsForJob(Request $request, $jobId)
    {
        // Authenticate as mitra via simple token and ensure ownership
        $token = $request->bearerToken();
        if (!$token) return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $mitra = $userId ? \App\Models\MitraPerusahaan::where('user_id', $userId)->first() : null;
        if (!$mitra) return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);

        $job = LowonganPekerjaan::where('id', $jobId)->where('mitra_id', $mitra->id)->first();
        if (!$job) return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan atau bukan milik Anda'], 404);

        $rows = DB::table('pelamars as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('alumnis as a', 'a.user_id', '=', 'u.id')
            ->select('p.*', 'u.name', 'u.email', 'a.file_cv')
            ->where('p.lowongan_id', $job->id)
            ->orderBy('p.created_at', 'desc')
            ->get();

        $apps = $rows->map(function($r){
            return [
                'id' => $r->id,
                'user_id' => $r->user_id,
                'lowongan_id' => $r->lowongan_id,
                'status' => $r->status,
                'created_at' => $r->created_at,
                'updated_at' => $r->updated_at,
                'pelamar' => [
                    'name' => $r->name,
                    'email' => $r->email,
                    'cv_path' => $r->file_cv,
                    'cv_url' => $r->file_cv ? url('storage/'.$r->file_cv) : null,
                ],
            ];
        });

        return response()->json(['success' => true, 'data' => $apps]);
    }

    /**
     * Get alumni profile by user id (for mitra viewing applicant details)
     */
    public function alumniProfile(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);

        if ($user->hasRole('alumni')) {
            $alumni = $user->alumni()->with('dataAkademik', 'dataKeluarga', 'dokumenPendukung')->first();
            
            // Build profile array manually to ensure all fields are included
            $profileArray = null;
            $cvUrl = null;
            
            if ($alumni) {
                $profileArray = [
                    'id' => $alumni->id,
                    'user_id' => $alumni->user_id,
                    'nim' => $alumni->nim,
                    'nik' => $alumni->nik,
                    'no_hp' => $alumni->no_hp,
                    'tempat_lahir' => $alumni->tempat_lahir,
                    'tanggal_lahir' => $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : null,
                    'jenis_kelamin' => $alumni->jenis_kelamin,
                    'alamat' => $alumni->alamat,
                    'kota' => $alumni->kota,
                    'provinsi' => $alumni->provinsi,
                    'kode_pos' => $alumni->kode_pos,
                    'tentang_saya' => $alumni->tentang_saya,
                    'nama_bank' => $alumni->nama_bank,
                    'no_rekening' => $alumni->no_rekening,
                    'file_cv' => $alumni->file_cv,
                    'created_at' => $alumni->created_at,
                    'updated_at' => $alumni->updated_at,
                ];
                
                // Add CV URL if exists
                if ($alumni->file_cv) {
                    $cvUrl = url('storage/' . $alumni->file_cv);
                    $profileArray['cv_url'] = $cvUrl;
                    // Debug
                    \Log::info('CV URL generated: ' . $cvUrl . ' from file_cv: ' . $alumni->file_cv);
                } else {
                    \Log::info('No CV file found for alumni ID: ' . $alumni->id);
                }
                
                // Add academic fields
                if ($alumni->dataAkademik) {
                    $profileArray['program_studi'] = $alumni->dataAkademik->program_studi;
                    $profileArray['angkatan'] = $alumni->dataAkademik->tahun_masuk;
                    $profileArray['ipk'] = $alumni->dataAkademik->ipk ?? null;
                }
            }
            
            // Get supporting documents
            $dokumenPendukung = null;
            if ($alumni && $alumni->dokumenPendukung) {
                $dokumenPendukung = $alumni->dokumenPendukung->map(function($doc) {
                    $docArray = $doc->toArray();
                    if ($doc->file_path) {
                        $docArray['file_url'] = url('storage/' . $doc->file_path);
                    }
                    return $docArray;
                })->toArray();
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles' => ['alumni'],
                    ],
                    'profile' => $profileArray,
                    'cv_url' => $cvUrl,
                    'data_akademik' => $alumni && $alumni->dataAkademik ? $alumni->dataAkademik->toArray() : null,
                    'data_keluarga' => $alumni && $alumni->dataKeluarga ? $alumni->dataKeluarga->toArray() : null,
                    'dokumen_pendukung' => $dokumenPendukung,
                ],
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Bukan akun alumni'], 400);
    }
}
