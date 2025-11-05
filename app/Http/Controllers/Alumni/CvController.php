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
        $user = auth()->user();
        
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

        $totalFields = 0;
        $filledFields = 0;

        // === Data Pribadi (20 poin total) ===
        $personalFields = [
            $user->name,
            $user->email,
            $alumni->no_hp,
            $alumni->alamat,
            $alumni->tentang_saya,
        ];
        foreach ($personalFields as $field) {
            $totalFields += 4;
            if (!empty($field)) $filledFields += 4;
        }

        // === Riwayat Pendidikan (15 poin) ===
        $totalFields += 15;
        $riwayat = $alumni->riwayatPendidikan()
            ->whereNotNull('nama_sekolah')
            ->whereNotNull('strata')
            ->get();
        if ($riwayat->count() > 0) $filledFields += 15;

        // === Pengalaman Kerja (10 poin) ===
        $totalFields += 10;
        $pengalaman = $alumni->pengalamanKerja()
            ->whereNotNull('perusahaan_organisasi')
            ->get();
        if ($pengalaman->count() > 0) $filledFields += 10;

        // === Sertifikasi (10 poin) ===
        $totalFields += 10;
        $sertifikasi = $alumni->sertifikasi()->get();
        if ($sertifikasi->count() > 0) $filledFields += 10;

        // === Hard & Soft Skills (10 poin total) ===
        $totalFields += 10;
        if (!empty($alumni->keahlian)) $filledFields += 5;
        if (!empty($alumni->soft_skills)) $filledFields += 5;

        // === Data Keluarga (20 poin) ===
        $totalFields += 20;
        $keluarga = $alumni->dataKeluarga;
        if ($keluarga) {
            $fields = [
                $keluarga->nama_ayah,
                $keluarga->pekerjaan_ayah,
                $keluarga->nama_ibu,
                $keluarga->pekerjaan_ibu,
            ];
            $filledFields += (count(array_filter($fields)) / 4) * 20;
        }

        // === Dokumen Pendukung (20 poin) ===
        $totalFields += 20;
        // perbaikan penting: cari berdasarkan alumni_id *ATAU* user_id sementara
        $dokumen = $alumni->dokumenPendukung()
            ->orWhere('alumni_id', $alumni->user_id ?? null)
            ->get();
        if ($dokumen->count() > 0) {
            $filledFields += min(($dokumen->count() / 6) * 20, 20);
        }

        return round(($filledFields / $totalFields) * 100);
    }


    public function generateCv()
    {
        try {
            $user = auth()->user();
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
        $user = auth()->user();
        
        $alumni = Alumni::where('user_id', $user->id)
            ->with([
                'dataAkademik',
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

        return view('alumni.cv.preview', compact('alumni'));
    }

    public function publicCv($uri)
    {
        $alumni = Alumni::where('cv_uri', $uri)
            ->where('cv_public', true)
            ->with([
                'dataAkademik',
                'dataKeluarga',
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
            $user = auth()->user();
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
