<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\CvData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CvController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Load alumni dengan semua relasi yang dibutuhkan
        $alumni = Alumni::where('user_id', $user->id)
            ->with([
                'dataKeluarga',
                'dokumenPendukung',
                'riwayatPendidikan' => function($query) {
                    $query->orderBy('tahun_masuk', 'desc');
                },
                'pengalamanKerja' => function($query) {
                    $query->orderBy('mulai_kerja', 'desc');
                },
                'sertifikasi' => function($query) {
                    $query->orderBy('mulai_berlaku', 'desc');
                }
            ])
            ->first();

        // Calculate progress percentage
        $progressPercentage = $this->calculateProgress($user, $alumni);

        return view('alumni.cv.index', compact( 'alumni', 'progressPercentage'));
    }

    private function calculateProgress($user, $alumni)
    {
        if (!$alumni) return 0;

        $totalPoints = 100;
        $earnedPoints = 0;

        // === Data Pribadi (40 poin) - CORE FIELDS ONLY ===
        $corePersonalFields = [
            'name' => $user->name,
            'email' => $user->email,
            'nama_lengkap' => $alumni->nama_lengkap,
            'no_hp' => $alumni->no_hp,
            'alamat' => $alumni->alamat,
        ];
        
        $personalFilled = 0;
        foreach ($corePersonalFields as $value) {
            if (!empty($value)) {
                $personalFilled++;
            }
        }
        // 5 core fields = 40 points (8 points each)
        $earnedPoints += ($personalFilled / 5) * 40;

        // === Data Akademik (30 poin) - ANY ONE IS ENOUGH ===
        $academicPoints = 0;
        
        // Riwayat Pendidikan (10 poin)
        $riwayat = $alumni->riwayatPendidikan()
            ->whereNotNull('nama_sekolah')
            ->get();
        if ($riwayat->count() > 0) {
            $academicPoints += 10;
        }

        // Pengalaman Kerja (10 poin)
        $pengalaman = $alumni->pengalamanKerja()
            ->whereNotNull('perusahaan_organisasi')
            ->get();
        if ($pengalaman->count() > 0) {
            $academicPoints += 10;
        }

        // Sertifikasi (10 poin)
        $sertifikasi = $alumni->sertifikasi()
            ->whereNotNull('nama_sertifikasi')
            ->get();
        if ($sertifikasi->count() > 0) {
            $academicPoints += 10;
        }

        // Cap at 30 points max for academic section
        $earnedPoints += min($academicPoints, 30);

        // === Skills (20 poin) - ANY ONE IS ENOUGH ===
        $hardSkillsFilled = !empty($alumni->keahlian) && trim($alumni->keahlian) != '';
        $softSkillsFilled = !empty($alumni->soft_skills) && trim($alumni->soft_skills) != '';
        
        if ($hardSkillsFilled && $softSkillsFilled) {
            $earnedPoints += 20; // Both = full points
        } elseif ($hardSkillsFilled || $softSkillsFilled) {
            $earnedPoints += 15; // One = 15 points
        }

        // === Data Keluarga (5 poin) - OPTIONAL ===
        $keluarga = $alumni->dataKeluarga;
        if ($keluarga) {
            $familyFields = [
                $keluarga->nama_ayah,
                $keluarga->nama_ibu,
            ];
            $familyFilled = count(array_filter($familyFields, function($val) {
                return !empty($val);
            }));
            // 2 fields minimum for 5 points
            if ($familyFilled >= 2) {
                $earnedPoints += 5;
            } elseif ($familyFilled == 1) {
                $earnedPoints += 2.5;
            }
        }

        // === Dokumen Pendukung (5 poin) - OPTIONAL ===
        $dokumen = $alumni->dokumenPendukung()->get();
        if ($dokumen->count() >= 1) {
            $earnedPoints += 5; // Any document = 5 points
        }

        // Total: 40 + 30 + 20 + 5 + 5 = 100 poin
        return min(round($earnedPoints), 100);
    }


    public function generateCv()
    {
        try {
            $user = Auth::user();
            $alumni = Alumni::where('user_id', $user->id)->first();

            if (!$alumni) {
                return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
            }

            // Generate or reuse CV URI
            if (!$alumni->cv_uri) {
                $alumni->cv_uri = Str::random(32);
            }

            $alumni->cv_generated = true;
            $alumni->save();

            return redirect()->back()->with('success', 'CV berhasil di-generate! Anda sekarang dapat melihat CV Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function previewCv()
    {
        $user = Auth::user();
        
        $alumni = Alumni::where('user_id', $user->id)
            ->with([
                'dataKeluarga',
                'dokumenPendukung',
                'programStudi',
                'riwayatPendidikan' => function($query) {
                    $query->orderBy('tahun_masuk', 'desc');
                },
                'pengalamanKerja' => function($query) {
                    $query->orderBy('mulai_kerja', 'desc');
                },
                'sertifikasi' => function($query) {
                    $query->orderBy('mulai_berlaku', 'desc');
                }
            ])
            ->first();

        return view('alumni.cv.preview', compact('alumni'));
    }

    public function publicCv($uri)
    {
        $alumni = Alumni::where('cv_uri', $uri)
            ->where('cv_public', true)
            ->with([
                'dataKeluarga',
                'programStudi',
                'riwayatPendidikan' => function($query) {
                    $query->orderBy('tahun_masuk', 'desc');
                },
                'pengalamanKerja' => function($query) {
                    $query->orderBy('mulai_kerja', 'desc');
                },
                'sertifikasi' => function($query) {
                    $query->orderBy('mulai_berlaku', 'desc');
                }
            ])
            ->first();

        if (!$alumni) {
            abort(404, 'CV tidak ditemukan atau tidak dipublikasikan.');
        }

        return view('alumni.cv.public', compact('alumni'));
    }

    public function togglePublic()
    {
        try {
            $user = Auth::user();
            $alumni = Alumni::where('user_id', $user->id)->first();

            if (!$alumni) {
                return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
            }

            if (!$alumni->cv_generated) {
                return redirect()->back()->with('error', 'Harap generate CV terlebih dahulu sebelum mempublikasikan.');
            }

            // Toggle public status
            $alumni->cv_public = !$alumni->cv_public;
            $alumni->save();

            $message = $alumni->cv_public 
                ? 'CV Anda sekarang dapat diakses publik!' 
                : 'CV Anda sekarang bersifat privat.';

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeCvData(Request $request)
    {
        $request->validate([
            'tipe_data' => 'required|in:pendidikan,pengalaman,keahlian,prestasi,organisasi',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'periode' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $alumni = $user->alumni;

        CvData::create([
            'alumni_id' => $alumni->id,
            'tipe_data' => $request->tipe_data,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'periode' => $request->periode,
            'instansi' => $request->instansi,
            'urutan' => CvData::where('alumni_id', $alumni->id)->where('tipe_data', $request->tipe_data)->max('urutan') + 1,
        ]);

        return redirect()->back()->with('success', 'Data CV berhasil ditambahkan!');
    }

    public function updateCvData(Request $request, $id)
    {
        $request->validate([
            'tipe_data' => 'required|in:pendidikan,pengalaman,keahlian,prestasi,organisasi',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'periode' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $cvData = CvData::where('id', $id)->where('alumni_id', $user->alumni->id)->firstOrFail();

        $cvData->update($request->all());

        return redirect()->back()->with('success', 'Data CV berhasil diperbarui!');
    }

    public function destroyCvData($id)
    {
        $user = Auth::user();
        $cvData = CvData::where('id', $id)->where('alumni_id', $user->alumni->id)->firstOrFail();

        $cvData->delete();

        return redirect()->back()->with('success', 'Data CV berhasil dihapus!');
    }

    

    private function generateCvDataFromAlumni($alumni)
    {
        // Generate pendidikan data from data akademik
        if ($alumni->dataAkademik) {
            CvData::updateOrCreate(
                [
                    'alumni_id' => $alumni->id,
                    'tipe_data' => 'pendidikan',
                    'judul' => $alumni->dataAkademik->program_studi ?? 'Program Studi',
                ],
                [
                    'deskripsi' => 'Program studi yang ditempuh selama kuliah',
                    'periode' => ($alumni->dataAkademik->tahun_masuk ?? '') . ' - ' . ($alumni->dataAkademik->tahun_lulus ?? ''),
                    'instansi' => $alumni->dataAkademik->universitas ?? 'Universitas',
                    'urutan' => 1,
                ]
            );
        }

        // Generate keahlian from existing data
        if ($alumni->keahlian) {
            $keahlianArray = explode(',', $alumni->keahlian);
            foreach ($keahlianArray as $index => $keahlian) {
                CvData::updateOrCreate(
                    [
                        'alumni_id' => $alumni->id,
                        'tipe_data' => 'keahlian',
                        'judul' => trim($keahlian),
                    ],
                    [
                        'urutan' => $index + 1,
                    ]
                );
            }
        }

        // Generate prestasi from existing data
        if ($alumni->prestasi) {
            $prestasiArray = explode(',', $alumni->prestasi);
            foreach ($prestasiArray as $index => $prestasi) {
                CvData::updateOrCreate(
                    [
                        'alumni_id' => $alumni->id,
                        'tipe_data' => 'prestasi',
                        'judul' => trim($prestasi),
                    ],
                    [
                        'urutan' => $index + 1,
                    ]
                );
            }
        }

        // Generate organisasi from existing data
        if ($alumni->organisasi) {
            $organisasiArray = explode(',', $alumni->organisasi);
            foreach ($organisasiArray as $index => $organisasi) {
                CvData::updateOrCreate(
                    [
                        'alumni_id' => $alumni->id,
                        'tipe_data' => 'organisasi',
                        'judul' => trim($organisasi),
                    ],
                    [
                        'urutan' => $index + 1,
                    ]
                );
            }
        }
    }
}
