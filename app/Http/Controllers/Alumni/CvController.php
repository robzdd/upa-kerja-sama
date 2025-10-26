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
        $alumni = $user->alumni;

        // Calculate progress percentage
        $progressPercentage = $this->calculateProgressPercentage($alumni);

        return view('alumni.cv.index', compact('alumni', 'progressPercentage'));
    }

    public function generateCv()
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        if (!$alumni) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan!');
        }

        // Check if minimum data is available
        $progressPercentage = $this->calculateProgressPercentage($alumni);

        if ($progressPercentage < 30) {
            return redirect()->back()->with('error', 'Data CV belum lengkap. Minimal 30% data harus diisi untuk dapat generate CV. Progress saat ini: ' . $progressPercentage . '%');
        }

        // Clear existing CV data if regenerating
        if ($alumni->cv_generated) {
            $alumni->cvData()->delete();
        }

        // Generate unique CV URI if not exists
        if (!$alumni->cv_uri) {
            $alumni->cv_uri = Str::slug($user->name) . '-' . Str::random(8);
            $alumni->save();
        }

        // Generate CV data from existing alumni data
        $this->generateCvDataFromAlumni($alumni);

        return redirect()->back()->with('success', 'CV berhasil di-generate! Progress: ' . $progressPercentage . '%');
    }

    public function previewCv()
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        return view('alumni.cv.preview', compact('alumni'));
    }

    public function publicCv($uri)
    {
        $alumni = Alumni::where('cv_uri', $uri)->where('cv_public', true)->firstOrFail();

        return view('alumni.cv.public', compact('alumni'));
    }

    public function togglePublic()
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        $alumni->cv_public = !$alumni->cv_public;
        $alumni->save();

        $status = $alumni->cv_public ? 'dipublikasikan' : 'disembunyikan';

        return redirect()->back()->with('success', "CV berhasil {$status}!");
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

    private function calculateProgressPercentage($alumni)
    {
        if (!$alumni) {
            return 0;
        }

        $totalFields = 0;
        $completedFields = 0;

        // Data Pribadi (4 fields)
        $personalFields = [
            'nama_lengkap' => $alumni->nama_lengkap,
            'email' => auth()->user()->email,
            'no_hp' => $alumni->no_hp,
            'alamat' => $alumni->alamat,
        ];

        foreach ($personalFields as $field => $value) {
            $totalFields++;
            if (!empty($value)) {
                $completedFields++;
            }
        }

        // Data Akademik (4 fields)
        if ($alumni->dataAkademik) {
            $academicFields = [
                'program_studi' => $alumni->dataAkademik->program_studi,
                'universitas' => $alumni->dataAkademik->universitas,
                'tahun_masuk' => $alumni->dataAkademik->tahun_masuk,
                'tahun_lulus' => $alumni->dataAkademik->tahun_lulus,
            ];

            foreach ($academicFields as $field => $value) {
                $totalFields++;
                if (!empty($value)) {
                    $completedFields++;
                }
            }
        } else {
            $totalFields += 4; // Add 4 fields even if dataAkademik doesn't exist
        }

        // Data Keluarga (2 fields)
        if ($alumni->dataKeluarga) {
            $familyFields = [
                'nama_ayah' => $alumni->dataKeluarga->nama_ayah,
                'nama_ibu' => $alumni->dataKeluarga->nama_ibu,
            ];

            foreach ($familyFields as $field => $value) {
                $totalFields++;
                if (!empty($value)) {
                    $completedFields++;
                }
            }
        } else {
            $totalFields += 2; // Add 2 fields even if dataKeluarga doesn't exist
        }

        // Dokumen Pendukung (1 field)
        $totalFields++;
        if ($alumni->dokumenPendukung && $alumni->dokumenPendukung->count() > 0) {
            $completedFields++;
        }

        // CV Data (keahlian, pengalaman, prestasi, organisasi)
        $cvDataTypes = ['keahlian', 'pengalaman', 'prestasi', 'organisasi'];
        foreach ($cvDataTypes as $type) {
            $totalFields++;
            if ($alumni->cvData && $alumni->cvData->where('tipe_data', $type)->count() > 0) {
                $completedFields++;
            }
        }

        if ($totalFields == 0) {
            return 0;
        }

        return round(($completedFields / $totalFields) * 100);
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
