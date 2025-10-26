<?php

// File: app/Http/Controllers/Alumni/ProfileController.php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\DataAkademik;
use App\Models\DataKeluarga;
use App\Models\DokumenPendukung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        $dataAkademik = $alumni->dataAkademik ?? null;
        $dataKeluarga = $alumni->dataKeluarga ?? null;
        $dokumenPendukung = $alumni->dokumenPendukung ?? [];

        if (!$user || !$alumni) {
            return redirect()->route('alumni.dashboard')->with('error', 'Data alumni tidak ditemukan');
        }

        return view('alumni.profile', compact('user', 'alumni', 'dataAkademik', 'dataKeluarga', 'dokumenPendukung'));
    }

    public function edit()
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        $dataAkademik = $alumni->dataAkademik;
        $dataKeluarga = $alumni->dataKeluarga;

        if (!$user || !$alumni) {
            return redirect()->route('alumni.dashboard')->with('error', 'Data alumni tidak ditemukan');
        }

        return view('alumni.profile-edit', compact('user', 'alumni', 'dataAkademik', 'dataKeluarga'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        if (!$user || !$alumni) {
            return redirect()->route('alumni.dashboard')->with('error', 'Data alumni tidak ditemukan');
        }

        $formType = $request->input('form_type');

        if ($formType === 'data_pribadi') {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'no_hp' => 'nullable|string|max:20',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'alamat' => 'nullable|string|max:500',
                'kota' => 'nullable|string|max:100',
                'provinsi' => 'nullable|string|max:100',
                'kode_pos' => 'nullable|string|max:10',
                'tentang_saya' => 'nullable|string|max:1000',
                'nama_bank' => 'nullable|string|max:255',
                'no_rekening' => 'nullable|string|max:20',
            ]);

            // Update user data
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update alumni (data pribadi)
            $alumni->update([
                'no_hp' => $validated['no_hp'] ?? $alumni->no_hp,
                'tempat_lahir' => $validated['tempat_lahir'] ?? $alumni->tempat_lahir,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? $alumni->tanggal_lahir,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?? $alumni->jenis_kelamin,
                'alamat' => $validated['alamat'] ?? $alumni->alamat,
                'kota' => $validated['kota'] ?? $alumni->kota ?? null,
                'provinsi' => $validated['provinsi'] ?? $alumni->provinsi ?? null,
                'kode_pos' => $validated['kode_pos'] ?? $alumni->kode_pos ?? null,
                'tentang_saya' => $validated['tentang_saya'] ?? $alumni->tentang_saya,
                'nama_bank' => $validated['nama_bank'] ?? $alumni->nama_bank,
                'no_rekening' => $validated['no_rekening'] ?? $alumni->no_rekening,
            ]);

            return redirect()->route('alumni.profile.edit')->with('success', 'Data pribadi berhasil diperbarui!');

        } elseif ($formType === 'data_akademik') {
            $validated = $request->validate([
                'nim' => 'nullable|string|max:20|unique:data_akademiks,nim,' . ($alumni->dataAkademik->id ?? null),
                'program_studi' => 'nullable|string|max:255',
                'tahun_masuk' => 'nullable|integer|min:1900|max:' . date('Y'),
                'tahun_lulus' => 'nullable|integer|min:1900|max:' . date('Y'),
                'ipk' => 'nullable|numeric|min:0|max:4',
                'universitas' => 'nullable|string|max:255',
                'hard_skills' => 'nullable|array',
                'hard_skills.*' => 'nullable|string|max:255',
                'soft_skills' => 'nullable|array',
                'soft_skills.*' => 'nullable|string|max:255',
            ]);

            // Update atau create data akademik
            DataAkademik::updateOrCreate(
                ['alumni_id' => $alumni->id],
                [
                    'nim' => $validated['nim'] ?? null,
                    'program_studi' => $validated['program_studi'] ?? null,
                    'tahun_masuk' => $validated['tahun_masuk'] ?? null,
                    'tahun_lulus' => $validated['tahun_lulus'] ?? null,
                    'ipk' => $validated['ipk'] ?? null,
                    'universitas' => $validated['universitas'] ?? null,
                ]
            );

            // Update hard skills
            if (isset($validated['hard_skills'])) {
                $hardSkills = array_filter($validated['hard_skills'], function($skill) {
                    return !empty(trim($skill));
                });
                $alumni->update(['keahlian' => implode(',', $hardSkills)]);
            }

            // Update soft skills
            if (isset($validated['soft_skills'])) {
                $softSkills = array_filter($validated['soft_skills'], function($skill) {
                    return !empty(trim($skill));
                });
                $alumni->update(['soft_skills' => implode(',', $softSkills)]);
            }

            return redirect()->route('alumni.profile.edit')->with('success', 'Data akademik berhasil diperbarui!');

        } elseif ($formType === 'data_keluarga') {
            $validated = $request->validate([
                'nama_ayah' => 'nullable|string|max:255',
                'pekerjaan_ayah' => 'nullable|string|max:255',
                'nama_ibu' => 'nullable|string|max:255',
                'pekerjaan_ibu' => 'nullable|string|max:255',
                'nama_wali' => 'nullable|string|max:255',
                'pekerjaan_wali' => 'nullable|string|max:255',
                'alamat_keluarga' => 'nullable|string|max:500',
                'jumlah_saudara' => 'nullable|integer|min:0',
            ]);

            // Update atau create data keluarga
            DataKeluarga::updateOrCreate(
                ['alumni_id' => $alumni->id],
                [
                    'nama_ayah' => $validated['nama_ayah'] ?? null,
                    'pekerjaan_ayah' => $validated['pekerjaan_ayah'] ?? null,
                    'nama_ibu' => $validated['nama_ibu'] ?? null,
                    'pekerjaan_ibu' => $validated['pekerjaan_ibu'] ?? null,
                    'nama_wali' => $validated['nama_wali'] ?? null,
                    'pekerjaan_wali' => $validated['pekerjaan_wali'] ?? null,
                    'alamat_keluarga' => $validated['alamat_keluarga'] ?? null,
                    'jumlah_saudara' => $validated['jumlah_saudara'] ?? null,
                ]
            );

            return redirect()->route('alumni.profile.edit')->with('success', 'Data keluarga berhasil diperbarui!');
        }

        return redirect()->route('alumni.profile.edit')->with('error', 'Form tidak valid');
    }

    public function uploadDokumen(Request $request)
    {
        $validated = $request->validate([
            'tipe_dokumen' => 'required|string',
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        $user = Auth::user();
        $alumni = $user->alumni;

        if (!$alumni) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan');
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('dokumen-alumni/' . $alumni->id, $filename, 'public');

        DokumenPendukung::create([
            'alumni_id' => $alumni->id,
            'tipe_dokumen' => $validated['tipe_dokumen'],
            'nama_dokumen' => $validated['nama_dokumen'],
            'path_file' => $path,
            'ukuran_file' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function deleteDokumen($id)
    {
        $dokumen = DokumenPendukung::findOrFail($id);

        // Validasi kepemilikan
        if ($dokumen->alumni->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus dokumen ini');
        }

        // Hapus file
        if (Storage::disk('public')->exists($dokumen->path_file)) {
            Storage::disk('public')->delete($dokumen->path_file);
        }

        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }

    public function generateCV($alumni, $user)
    {
        $dataAkademik = $alumni->dataAkademik;
        $dataKeluarga = $alumni->dataKeluarga;

        // Generate HTML CV
        $html = view('alumni.cv-template', compact('alumni', 'user', 'dataAkademik', 'dataKeluarga'))->render();

        // Generate PDF
        $pdf = PDF::loadHTML($html);
        $filename = 'cv_' . $user->id . '.pdf';
        $path = 'cv-alumni/' . $filename;

        // Simpan ke storage
        Storage::disk('public')->put($path, $pdf->output());

        // Update alumni dengan path CV
        $alumni->update([
            'file_cv' => $path,
            'cv_updated_at' => now(),
        ]);
    }

    public function downloadCv()
    {
        $user = Auth::user();
        $alumni = $user->alumni;

        if (!$user || !$alumni) {
            return redirect()->route('alumni.dashboard')->with('error', 'Data alumni tidak ditemukan');
        }

        if ($alumni->file_cv && Storage::disk('public')->exists($alumni->file_cv)) {
            return Storage::disk('public')->download($alumni->file_cv, 'CV_' . $user->name . '.pdf');
        }

        return redirect()->back()->with('error', 'File CV tidak ditemukan');
    }

    public function viewCv()
    {
        $user = Auth::user();
        $alumni = $user->alumni;
        $dataAkademik = $alumni->dataAkademik;
        $dataKeluarga = $alumni->dataKeluarga;

        if (!$user || !$alumni) {
            return redirect()->route('alumni.dashboard')->with('error', 'Data alumni tidak ditemukan');
        }

        return view('alumni.cv-view', compact('user', 'alumni', 'dataAkademik', 'dataKeluarga'));
    }

    public function destroy()
    {
        $user = Auth::user();

        if ($user->alumni) {
            // Hapus dokumen pendukung
            foreach ($user->alumni->dokumenPendukung as $dokumen) {
                if (Storage::disk('public')->exists($dokumen->path_file)) {
                    Storage::disk('public')->delete($dokumen->path_file);
                }
                $dokumen->delete();
            }

            // Hapus data akademik
            $user->alumni->dataAkademik?->delete();

            // Hapus data keluarga
            $user->alumni->dataKeluarga?->delete();

            // Hapus CV
            if ($user->alumni->file_cv && Storage::disk('public')->exists($user->alumni->file_cv)) {
                Storage::disk('public')->delete($user->alumni->file_cv);
            }

            // Hapus alumni
            $user->alumni->delete();
        }

        // Hapus user
        $user->delete();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Akun Anda telah dihapus');
    }
}
