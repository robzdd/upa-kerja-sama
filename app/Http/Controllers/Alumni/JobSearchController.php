<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\LowonganPekerjaan;
use App\Models\MitraPerusahaan; // Added this line
use Illuminate\Support\Facades\Auth;
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
        return view('alumni.lowongan_detail', compact('lowongan'));
    }

    public function getJobDetails($id)
    {
        $job = LowonganPekerjaan::with('mitra')->findOrFail($id);
        
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = \App\Models\Pelamar::where('user_id', Auth::id())
                ->where('lowongan_id', $id)
                ->exists();
        }

        $response = $job->toArray();
        $response['has_applied'] = $hasApplied;
        $response['mitra'] = $job->mitra;

        return response()->json($response);
    }

    public function getRecommendations(Request $request)
    {
        // Get authenticated user
        $user = Auth::user();
        
        if (!$user || !$user->alumni) {
            return response()->json([
                'success' => false,
                'message' => 'Profil alumni tidak ditemukan.'
            ], 404);
        }

        $alumni = $user->alumni;

        // Load relationships
        $alumni->load(['programStudi', 'pengalamanKerja', 'riwayatPendidikan']);

        // Check if profile is complete enough for recommendations
        if (!$alumni->program_studi_id) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi profil Anda (Program Studi) untuk mendapatkan rekomendasi yang akurat.'
            ], 400);
        }

        // Get alumni data for matching
        $alumniProdi = $alumni->program_studi_id;
        $alumniSkills = array_merge(
            $alumni->hard_skills_array ?? [],
            $alumni->soft_skills_array ?? []
        );
        
        // Calculate total work experience in years
        $totalExperience = 0;
        if ($alumni->pengalamanKerja && $alumni->pengalamanKerja->count() > 0) {
            foreach ($alumni->pengalamanKerja as $exp) {
                $start = \Carbon\Carbon::parse($exp->mulai_kerja);
                $end = $exp->selesai_kerja ? \Carbon\Carbon::parse($exp->selesai_kerja) : now();
                $totalExperience += $start->diffInYears($end);
            }
        }

        // Get highest education level
        $alumniEducation = 'D3'; // Default
        if ($alumni->riwayatPendidikan && $alumni->riwayatPendidikan->count() > 0) {
            $latestEducation = $alumni->riwayatPendidikan->first();
            $alumniEducation = $latestEducation->jenjang ?? 'D3';
        }

        // Fetch all active jobs
        $jobs = LowonganPekerjaan::with('mitra')
            ->where('status_aktif', true)
            ->get();

        $recommendedJobs = [];
        $savedJobIds = $alumni->savedJobs()->pluck('lowongan_pekerjaan_id')->toArray();

        foreach ($jobs as $job) {
            $score = 0;

            // 1. Program Study Match (30%)
            $prodiScore = 0;
            if ($job->prodi_diizinkan && is_array($job->prodi_diizinkan)) {
                // Check if alumni's program study is in the allowed list
                $prodiNames = $job->prodi_diizinkan;
                $alumniProdiName = $alumni->programStudi ? $alumni->programStudi->program_studi : '';
                
                foreach ($prodiNames as $allowedProdi) {
                    if (stripos($allowedProdi, $alumniProdiName) !== false || 
                        stripos($alumniProdiName, $allowedProdi) !== false) {
                        $prodiScore = 30;
                        break;
                    }
                }
            } else {
                // If no specific prodi required, give partial score
                $prodiScore = 15;
            }

            // 2. Skills Match (30%)
            $skillsScore = 0;
            if ($job->skill_required && is_array($job->skill_required) && count($alumniSkills) > 0) {
                $matchingSkills = 0;
                $totalRequiredSkills = count($job->skill_required);
                
                foreach ($job->skill_required as $requiredSkill) {
                    foreach ($alumniSkills as $alumniSkill) {
                        if (stripos($alumniSkill, $requiredSkill) !== false || 
                            stripos($requiredSkill, $alumniSkill) !== false) {
                            $matchingSkills++;
                            break;
                        }
                    }
                }
                
                if ($totalRequiredSkills > 0) {
                    $skillsScore = ($matchingSkills / $totalRequiredSkills) * 30;
                }
            } else if (!$job->skill_required || count($job->skill_required) == 0) {
                // If no specific skills required, give partial score
                $skillsScore = 15;
            }

            // 3. Experience Match (20%)
            $experienceScore = 0;
            if ($job->pengalaman_minimal) {
                // Extract years from pengalaman_minimal (e.g., "2 tahun" -> 2)
                preg_match('/\d+/', $job->pengalaman_minimal, $matches);
                $requiredYears = isset($matches[0]) ? (int)$matches[0] : 0;
                
                if ($totalExperience >= $requiredYears) {
                    $experienceScore = 20;
                } else if ($totalExperience > 0) {
                    // Partial score based on how close they are
                    $experienceScore = ($totalExperience / $requiredYears) * 20;
                }
            } else {
                // No experience required
                $experienceScore = 20;
            }

            // 4. Education Level Match (20%)
            $educationScore = 0;
            $educationLevels = ['D3' => 1, 'D4' => 2, 'S1' => 2, 'S2' => 3, 'S3' => 4];
            
            $alumniLevel = $educationLevels[$alumniEducation] ?? 1;
            $requiredLevel = $educationLevels[$job->jenjang_pendidikan] ?? 1;
            
            if ($alumniLevel >= $requiredLevel) {
                $educationScore = 20;
            } else {
                // Partial score if close
                $educationScore = ($alumniLevel / $requiredLevel) * 20;
            }

            // Calculate total score
            $totalScore = $prodiScore + $skillsScore + $experienceScore + $educationScore;
            
            // Add job with score to recommendations
            $jobData = $job->toArray();
            $jobData['similarity_score'] = round($totalScore, 1);
            $jobData['is_saved'] = in_array($job->id, $savedJobIds);
            $recommendedJobs[] = $jobData;
        }

        // Sort by similarity score (highest first)
        usort($recommendedJobs, function($a, $b) {
            return $b['similarity_score'] <=> $a['similarity_score'];
        });

        // Calculate statistics
        $totalJobs = count($recommendedJobs);
        $averageMatch = $totalJobs > 0 
            ? round(array_sum(array_column($recommendedJobs, 'similarity_score')) / $totalJobs, 1)
            : 0;

        return response()->json([
            'success' => true,
            'total_jobs' => $totalJobs,
            'average_match' => $averageMatch,
            'jobs' => $recommendedJobs
        ]);
    }

    public function toggleSave($id)
    {
        $user = Auth::user();
        if (!$user || !$user->alumni) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $alumni = $user->alumni;
        $job = LowonganPekerjaan::findOrFail($id);

        $alumni->savedJobs()->toggle($job->id);

        $isSaved = $alumni->savedJobs()->where('lowongan_pekerjaan_id', $job->id)->exists();

        return response()->json([
            'success' => true,
            'message' => $isSaved ? 'Lowongan berhasil disimpan' : 'Lowongan dihapus dari simpanan',
            'is_saved' => $isSaved
        ]);
    }

    public function savedJobs()
    {
        $user = Auth::user();
        if (!$user || !$user->alumni) {
            return redirect()->route('alumni.login');
        }

        $jobs = $user->alumni->savedJobs()->with('mitra')->latest('saved_jobs.created_at')->paginate(9);
        
        return view('alumni.saved_jobs', compact('jobs'));
    }
}
