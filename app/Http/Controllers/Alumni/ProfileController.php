<?php

namespace App\Http\Controllers\Alumni;

use App\Models\Alumni;
use App\Models\DataKeluarga;
use Illuminate\Http\Request;
use App\Models\DokumenPendukung;
use App\Models\RiwayatPendidikan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\PengalamanSertifikasi;
use App\Models\PengalamanKerjaOrganisasi;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)
            ->with([
                'programStudi',
                'dataKeluarga',
                'dokumenPendukung',
                'riwayatPendidikan',
                'pengalamanKerja',
                'sertifikasi'
            ])
            ->first();

        return view('alumni.profile', compact('user', 'alumni'));
    }

    public function edit()
    {
        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)->firstOrCreate(['user_id' => $user->id]);

        // relasi pakai alumni_id
        $dataKeluarga = DataKeluarga::where('alumni_id', $alumni->id)->first();
        $dokumenPendukung = DokumenPendukung::where('alumni_id', $alumni->id)->get();

        // Load related data
        $riwayatPendidikan = RiwayatPendidikan::where('user_id', $user->id)
            ->orderBy('tahun_masuk', 'desc')
            ->get();

        $pengalamanKerja = PengalamanKerjaOrganisasi::where('user_id', $user->id)
            ->orderBy('mulai_kerja', 'desc')
            ->get();

        $sertifikasi = PengalamanSertifikasi::where('user_id', $user->id)
            ->orderBy('mulai_berlaku', 'desc')
            ->get();

        $programStudis = \App\Models\ProgramStudi::orderBy('program_studi', 'asc')->get();

        return view('alumni.profile-edit', compact(
            'user',
            'alumni',
            'dataKeluarga',
            'dokumenPendukung',
            'riwayatPendidikan',
            'pengalamanKerja',
            'sertifikasi',
            'programStudis'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $formType = $request->input('form_type');
        $alumni = Alumni::where('user_id', $user->id)->first();

        try {
            switch ($formType) {
                case 'data_pribadi':
                    $this->updateDataPribadi($request, $user);
                    $message = 'Data pribadi berhasil diperbarui!';
                    break;

                case 'data_akademik':
                    $this->updateDataAkademik($request, $user);
                    $message = 'Data akademik berhasil diperbarui!';
                    break;

                case 'data_keluarga':
                    $this->updateDataKeluarga($request, $alumni);
                    $message = 'Data keluarga berhasil diperbarui!';
                    break;

                default:
                    return redirect()->back()->with('error', 'Tipe form tidak valid.');
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function updateDataPribadi(Request $request, $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'nik' => 'nullable|string|max:16',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'nama_bank' => 'nullable|string|max:255',
            'no_rekening' => 'nullable|string|max:50',
            'tentang_saya' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $hardSkills = implode(', ', array_filter($request->input('hard_skills', [])));
        $softSkills = implode(', ', array_filter($request->input('soft_skills', [])));

        Alumni::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $validated['nama_lengkap'],
                'no_hp' => $validated['no_hp'] ?? null,
                'nik' => $validated['nik'] ?? null,
                'tempat_lahir' => $validated['tempat_lahir'] ?? null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'kota' => $validated['kota'] ?? null,
                'provinsi' => $validated['provinsi'] ?? null,
                'kode_pos' => $validated['kode_pos'] ?? null,
                'nama_bank' => $validated['nama_bank'] ?? null,
                'no_rekening' => $validated['no_rekening'] ?? null,
                'tentang_saya' => $validated['tentang_saya'] ?? null,
                'keahlian' => $hardSkills ?: null,
                'soft_skills' => $softSkills ?: null,
            ]
        );
    }

    private function updateDataAkademik(Request $request, $user)
    {
        Alumni::updateOrCreate(
            ['user_id' => $user->id],
            [
                'program_studi_id' => $request->program_studi_id,
            ]
        );
    }

    private function updateDataKeluarga(Request $request, $alumni)
    {
        $validated = $request->validate([
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'alamat_keluarga' => 'nullable|string',
        ]);

        DataKeluarga::updateOrCreate(
            ['alumni_id' => $alumni->id],
            $validated
        );
    }

    // ===== RIWAYAT PENDIDIKAN METHODS =====
    
    public function storePendidikan(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'program_studi' => 'nullable|string|max:255',
            'strata' => 'required|string',
            'tahun_masuk' => 'required|date',
            'tahun_lulus' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->filled('pendidikan_id')) {
            $pendidikan = RiwayatPendidikan::where('user_id', Auth::id())
                ->findOrFail($request->pendidikan_id);
            $pendidikan->update($validated);
            $message = 'Riwayat pendidikan berhasil diperbarui!';
        } else {
            RiwayatPendidikan::create($validated);
            $message = 'Riwayat pendidikan berhasil ditambahkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function editPendidikan($id)
    {
        $pendidikan = RiwayatPendidikan::where('user_id', Auth::id())
            ->findOrFail($id);
        
        return response()->json($pendidikan);
    }

    public function destroyPendidikan($id)
    {
        try {
            $pendidikan = RiwayatPendidikan::where('user_id', Auth::id())
                ->findOrFail($id);
            $pendidikan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Riwayat pendidikan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus riwayat pendidikan: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===== PENGALAMAN KERJA/ORGANISASI METHODS =====
    
    public function storePengalaman(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:organisasi,perusahaan',
            'perusahaan_organisasi' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'mulai_kerja' => 'required|date',
            'selesai_kerja' => 'nullable|date',
            'deskripsi_piri' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->filled('pengalaman_id')) {
            $pengalaman = PengalamanKerjaOrganisasi::where('user_id', Auth::id())
                ->findOrFail($request->pengalaman_id);
            $pengalaman->update($validated);
            $message = 'Pengalaman berhasil diperbarui!';
        } else {
            PengalamanKerjaOrganisasi::create($validated);
            $message = 'Pengalaman berhasil ditambahkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function editPengalaman($id)
    {
        $pengalaman = PengalamanKerjaOrganisasi::where('user_id', Auth::id())
            ->findOrFail($id);
        
        return response()->json($pengalaman);
    }

    public function destroyPengalaman($id)
    {
        try {
            $pengalaman = PengalamanKerjaOrganisasi::where('user_id', Auth::id())
                ->findOrFail($id);
            $pengalaman->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pengalaman berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pengalaman: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===== SERTIFIKASI METHODS =====
    
    public function storeSertifikasi(Request $request)
    {
        $validated = $request->validate([
            'nama_sertifikasi' => 'required|string|max:255',
            'lembaga_sertifikasi' => 'required|string|max:255',
            'mulai_berlaku' => 'required|date',
            'selesai_berlaku' => 'nullable|date',
            'deskripsi' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->filled('sertifikasi_id')) {
            $sertifikasi = PengalamanSertifikasi::where('user_id', Auth::id())
                ->findOrFail($request->sertifikasi_id);
            $sertifikasi->update($validated);
            $message = 'Sertifikasi berhasil diperbarui!';
        } else {
            PengalamanSertifikasi::create($validated);
            $message = 'Sertifikasi berhasil ditambahkan!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function editSertifikasi($id)
    {
        $sertifikasi = PengalamanSertifikasi::where('user_id', Auth::id())
            ->findOrFail($id);
        
        return response()->json($sertifikasi);
    }

    public function destroySertifikasi($id)
    {
        try {
            $sertifikasi = PengalamanSertifikasi::where('user_id', Auth::id())
                ->findOrFail($id);
            $sertifikasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sertifikasi berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===== SECURITY METHODS =====

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)->first();

        if (!$alumni) {
            return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
        }

        // Delete old photo if exists
        if ($alumni->profile_photo && Storage::disk('public')->exists($alumni->profile_photo)) {
            Storage::disk('public')->delete($alumni->profile_photo);
        }

        // Store new photo
        $path = $request->file('profile_photo')->store('profile-photos', 'public');

        // Update alumni record
        $alumni->update([
            'profile_photo' => $path
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil diupload!');
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user();
        $alumni = Alumni::where('user_id', $user->id)->first();

        if (!$alumni || !$alumni->profile_photo) {
            return redirect()->back()->with('error', 'Tidak ada foto profil untuk dihapus.');
        }

        // Delete photo file
        if (Storage::disk('public')->exists($alumni->profile_photo)) {
            Storage::disk('public')->delete($alumni->profile_photo);
        }

        // Update alumni record
        $alumni->update([
            'profile_photo' => null
        ]);

        return redirect()->back()->with('success', 'Foto profil berhasil dihapus!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password tidak sesuai.');
        }

        // Delete user (soft delete)
        $user->delete();

        return redirect()->route('alumni.login')->with('success', 'Akun berhasil dihapus.');
    }
}