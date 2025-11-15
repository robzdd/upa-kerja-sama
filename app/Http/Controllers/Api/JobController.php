<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan;
use App\Models\User;
use App\Models\Alumni;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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

        // Get archived parameter
        $archived = $request->query('archived', 'false') === 'true';
        $search = $request->query('search');
        
        $query = LowonganPekerjaan::with('mitra')
            ->where('mitra_id', $mitra->id);
        
        // Filter berdasarkan archived status
        if ($archived) {
            $query->whereNotNull('archived_at');
        } else {
            $query->whereNull('archived_at');
        }
        
        // Filter berdasarkan search query
        if ($search && !empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->get();

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
     * Update a job owned by the authenticated mitra
     */
    public function update(Request $request, $id)
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

        $validated = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'deskripsi' => 'sometimes|required|string',
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

        $job->update($validated);

        return response()->json(['success' => true, 'message' => 'Lowongan berhasil diperbarui', 'data' => $job]);
    }

    /**
     * Activate a job (set status_aktif to true)
     */
    public function activate(Request $request, $id)
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

        $job->status_aktif = true;
        $job->save();

        return response()->json(['success' => true, 'message' => 'Lowongan berhasil diaktifkan', 'data' => $job]);
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
                'subject' => $r->subject ?? null,
                'message' => $r->message ?? null,
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
        $request->validate([
            'status' => 'required|in:melamar,lolos,interview,diterima,ditolak',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);
        
        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        if (!$app) return response()->json(['success' => false, 'message' => 'Lamaran tidak ditemukan'], 404);
        
        // Get user info for email
        $user = User::find($app->user_id);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        
        // Get job info for email
        $job = LowonganPekerjaan::find($app->lowongan_id);
        $jobTitle = $job ? $job->judul : 'Lowongan';
        
        // Update status and save subject/message
        DB::table('pelamars')->where('id', $applicationId)->update([
            'status' => $request->status, 
            'subject' => $request->subject,
            'message' => $request->message,
            'updated_at' => now()
        ]);
        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        
        // Send email if subject and message provided
        if ($request->has('subject') && $request->has('message') && $request->subject && $request->message) {
            try {
                // Get mitra info for email sender
                $token = $request->bearerToken();
                $parts = $token ? explode('|', base64_decode($token)) : [];
                $userId = $parts[0] ?? null;
                $sender = $userId ? User::find($userId) : null;
                $companyName = $sender ? $sender->name : 'Perusahaan';
                
                // Status labels
                $statusLabels = [
                    'melamar' => 'Lamaran Anda sedang ditinjau',
                    'lolos' => 'Selamat! Anda lolos tahap screening',
                    'interview' => 'Anda lolos ke tahap interview',
                    'diterima' => 'Selamat! Anda diterima',
                    'ditolak' => 'Update Lamaran Anda',
                ];
                
                $statusLabel = $statusLabels[$request->status] ?? 'Update Lamaran';
                
                // Send email
                Mail::to($user->email)->send(new \App\Mail\ApplicationStatusUpdate(
                    $user->name,
                    $jobTitle,
                    $request->status,
                    $statusLabel,
                    $request->subject,
                    $request->message,
                    $companyName
                ));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send email: ' . $e->getMessage());
            }
        }
        
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

        // Get archived parameter
        $archived = $request->query('archived', 'false') === 'true';
        $search = $request->query('search');
        
        $query = DB::table('pelamars as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('alumnis as a', 'a.user_id', '=', 'u.id')
            ->select('p.*', 'u.name', 'u.email', 'a.file_cv')
            ->where('p.lowongan_id', $job->id);
        
        // Filter archived
        if ($archived) {
            $query->whereNotNull('p.archived_at');
        } else {
            $query->whereNull('p.archived_at');
        }
        
        // Search filter
        if ($search && !empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('u.name', 'like', "%{$search}%")
                  ->orWhere('u.email', 'like', "%{$search}%")
                  ->orWhere('p.status', 'like', "%{$search}%");
            });
        }
        
        $rows = $query->orderBy('p.created_at', 'desc')->get();

        $apps = $rows->map(function($r){
            return [
                'id' => $r->id,
                'user_id' => $r->user_id,
                'lowongan_id' => $r->lowongan_id,
                'status' => $r->status,
                'archived_at' => $r->archived_at,
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

    /**
     * Archive an application
     */
    public function archiveApplication(Request $request, $applicationId)
    {
        $token = $request->bearerToken();
        if (!$token) return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $mitra = $userId ? \App\Models\MitraPerusahaan::where('user_id', $userId)->first() : null;
        if (!$mitra) return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);

        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        if (!$app) return response()->json(['success' => false, 'message' => 'Lamaran tidak ditemukan'], 404);

        // Verify job ownership
        $job = LowonganPekerjaan::where('id', $app->lowongan_id)->where('mitra_id', $mitra->id)->first();
        if (!$job) return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan atau bukan milik Anda'], 404);

        DB::table('pelamars')->where('id', $applicationId)->update([
            'archived_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => true, 'message' => 'Lamaran berhasil diarsipkan']);
    }

    /**
     * Unarchive an application
     */
    public function unarchiveApplication(Request $request, $applicationId)
    {
        $token = $request->bearerToken();
        if (!$token) return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        $parts = explode('|', base64_decode($token));
        $userId = $parts[0] ?? null;
        $mitra = $userId ? \App\Models\MitraPerusahaan::where('user_id', $userId)->first() : null;
        if (!$mitra) return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);

        $app = DB::table('pelamars')->where('id', $applicationId)->first();
        if (!$app) return response()->json(['success' => false, 'message' => 'Lamaran tidak ditemukan'], 404);

        // Verify job ownership
        $job = LowonganPekerjaan::where('id', $app->lowongan_id)->where('mitra_id', $mitra->id)->first();
        if (!$job) return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan atau bukan milik Anda'], 404);

        DB::table('pelamars')->where('id', $applicationId)->update([
            'archived_at' => null,
            'updated_at' => now()
        ]);

        return response()->json(['success' => true, 'message' => 'Lamaran berhasil dikembalikan dari arsip']);
    }

    /**
     * Archive a job (mitra)
     */
    public function archive(Request $request, $id)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        }

        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0] ?? null;

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Token tidak valid'], 401);
        }

        $mitra = MitraPerusahaan::where('user_id', $userId)->first();
        if (!$mitra) {
            return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);
        }

        $job = LowonganPekerjaan::where('id', $id)->where('mitra_id', $mitra->id)->first();
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan atau bukan milik Anda'], 404);
        }

        $job->update([
            'archived_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Lowongan berhasil diarsipkan']);
    }

    /**
     * Unarchive a job (mitra)
     */
    public function unarchive(Request $request, $id)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 401);
        }

        $decoded = base64_decode($token);
        $parts = explode('|', $decoded);
        $userId = $parts[0] ?? null;

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Token tidak valid'], 401);
        }

        $mitra = MitraPerusahaan::where('user_id', $userId)->first();
        if (!$mitra) {
            return response()->json(['success' => false, 'message' => 'Akun mitra tidak valid'], 401);
        }

        $job = LowonganPekerjaan::where('id', $id)->where('mitra_id', $mitra->id)->first();
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan atau bukan milik Anda'], 404);
        }

        $job->update([
            'archived_at' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Lowongan berhasil dikembalikan dari arsip']);
    }

    /**
     * Download all applicants data as ZIP file
     */
    public function downloadApplicants(Request $request, $jobId)
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

        // Get all applicants for this job
        $applicants = DB::table('pelamars as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('alumnis as a', 'a.user_id', '=', 'u.id')
            ->select('p.*', 'u.name', 'u.email', 'a.id as alumni_id')
            ->where('p.lowongan_id', $job->id)
            ->whereNull('p.archived_at')
            ->orderBy('p.created_at', 'desc')
            ->get();

        if ($applicants->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Tidak ada pelamar untuk lowongan ini'], 404);
        }

        // Create temporary ZIP file
        $zipFileName = 'data_pelamar_' . $jobId . '_' . time() . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Create temp directory if not exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return response()->json(['success' => false, 'message' => 'Gagal membuat file ZIP'], 500);
        }

        // Add job info file
        $jobInfo = [
            'judul_lowongan' => $job->judul,
            'posisi' => $job->posisi,
            'lokasi' => $job->lokasi,
            'tanggal_dibuat' => $job->created_at,
            'total_pelamar' => $applicants->count(),
            'tanggal_download' => now()->format('Y-m-d H:i:s'),
        ];
        $zip->addFromString('00_INFO_LOWONGAN.txt', json_encode($jobInfo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Process each applicant
        foreach ($applicants as $index => $applicant) {
            $alumni = Alumni::with('dataAkademik', 'dataKeluarga', 'dokumenPendukung')->find($applicant->alumni_id);
            
            if (!$alumni) continue;

            // Create folder for each applicant
            $folderName = ($index + 1) . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $applicant->name);
            
            // Add profile data
            $profileData = [
                'nama' => $applicant->name,
                'email' => $applicant->email,
                'status_lamaran' => $applicant->status,
                'tanggal_melamar' => $applicant->created_at,
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
            ];
            $zip->addFromString($folderName . '/01_Data_Pribadi.json', json_encode($profileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // Add academic data
            if ($alumni->dataAkademik) {
                $zip->addFromString($folderName . '/02_Data_Akademik.json', json_encode($alumni->dataAkademik->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            // Add family data
            if ($alumni->dataKeluarga) {
                $zip->addFromString($folderName . '/03_Data_Keluarga.json', json_encode($alumni->dataKeluarga->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }

            // Add CV if exists (from file_cv or from dokumen pendukung)
            $cvAdded = false;
            if ($alumni->file_cv && Storage::disk('public')->exists($alumni->file_cv)) {
                $cvPath = Storage::disk('public')->path($alumni->file_cv);
                $cvFileName = basename($alumni->file_cv);
                $zip->addFile($cvPath, $folderName . '/04_CV_' . $cvFileName);
                $cvAdded = true;
            }

            // Add supporting documents (including CV from dokumen pendukung if not already added)
            if ($alumni->dokumenPendukung && $alumni->dokumenPendukung->count() > 0) {
                $docIndex = 1;
                foreach ($alumni->dokumenPendukung as $doc) {
                    $filePath = $doc->file_path ?? $doc->path_file;
                    if ($filePath && Storage::disk('public')->exists($filePath)) {
                        $fullPath = Storage::disk('public')->path($filePath);
                        $fileName = $doc->file_name ?? $doc->nama_dokumen ?? basename($filePath);
                        $jenisDokumen = $doc->jenis_dokumen ?? $doc->tipe_dokumen ?? 'dokumen';
                        
                        // If CV from dokumen pendukung and not already added, add it as CV
                        if (strtolower($jenisDokumen) === 'cv' && !$cvAdded) {
                            $zip->addFile($fullPath, $folderName . '/04_CV_' . $fileName);
                            $cvAdded = true;
                        } else {
                            $zip->addFile($fullPath, $folderName . '/05_Dokumen_' . sprintf('%02d', $docIndex) . '_' . $jenisDokumen . '_' . $fileName);
                            $docIndex++;
                        }
                    }
                }
            }
        }

        $zip->close();

        // Return ZIP file as download
        return response()->download($zipPath, $zipFileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
        ])->deleteFileAfterSend(true);
    }
}
